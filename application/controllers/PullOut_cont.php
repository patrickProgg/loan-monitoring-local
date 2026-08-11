<?php
defined('BASEPATH') or exit('No direct script access allowed');

class PullOut_cont extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
    }

    public function get_pull_out()
    {
        $start = $this->input->post('start');
        $length = $this->input->post('length');
        $searchValue = trim($this->input->post('search')['value']);
        $history = $this->input->post('history');

        $order = $this->input->post('order');
        $orderColumnIndex = isset($order[0]['column']) ? $order[0]['column'] : 0;
        $orderDir = isset($order[0]['dir']) ? $order[0]['dir'] : 'DESC';

        $columns = [
            0 => 'id',
            1 => 'date_added',
            2 => 'process_fee',
            3 => 'ticket',
            4 => 'profit_share',
            5 => 'pull_out',
            6 => 'pull_out_capital',
            7 => 'total_pull_out'
        ];

        $orderColumn = $columns[$orderColumnIndex];

        $this->db->select('
            id, 
            date_added, 
            process_fee, 
            ticket, 
            profit_share, 
            pull_out, 
            pull_out_capital,
            total_pull_out
        ');

        if ($history) {
            $this->db->where('status', '1');
        } else {
            $this->db->where('status', '0');
        }

        $this->db->from('tbl_pull_out');

        if (!empty($searchValue)) {
            $this->db->group_start();
            $this->db->like('id', $searchValue);
            $this->db->or_like('date_added', $searchValue);
            $this->db->or_like('process_fee', $searchValue);
            $this->db->or_like('ticket', $searchValue);
            $this->db->or_like('profit_share', $searchValue);
            $this->db->or_like('pull_out', $searchValue);
            $this->db->or_like('total_pull_out', $searchValue);
            $this->db->group_end();
        }

        $this->db->order_by($orderColumn, $orderDir);

        $subQuery = clone $this->db;
        $recordsFiltered = $subQuery->get()->num_rows();

        $this->db->limit($length, $start);

        $query = $this->db->get();
        $data = $query->result_array();

        $this->db->select_sum('process_fee');
        $this->db->select_sum('ticket');
        $this->db->select_sum('profit_share');
        $this->db->select_sum('pull_out');
        $this->db->select_sum('pull_out_capital');
        $this->db->select_sum('total_pull_out');

        $this->db->where('status !=', '1');
        $this->db->from('tbl_pull_out');

        if (!empty($searchValue)) {
            $this->db->group_start();
            $this->db->like('id', $searchValue);
            $this->db->or_like('date_added', $searchValue);
            $this->db->or_like('process_fee', $searchValue);
            $this->db->or_like('ticket', $searchValue);
            $this->db->or_like('profit_share', $searchValue);
            $this->db->or_like('pull_out', $searchValue);
            $this->db->or_like('total_pull_out', $searchValue);
            $this->db->group_end();
        }

        $totalRow = $this->db->get()->row();
        $totalFee = $totalRow->process_fee ?? 0;
        $totalTicket = $totalRow->ticket ?? 0;
        $totalProfit = $totalRow->profit_share ?? 0;
        $totalPullOut = $totalRow->pull_out ?? 0;
        $totalPullOutCapital = $totalRow->pull_out_capital ?? 0;
        $totalAmount = $totalRow->total_pull_out ?? 0;

        echo json_encode([
            "draw" => intval($this->input->post('draw')),
            "recordsTotal" => $recordsFiltered,
            "recordsFiltered" => $recordsFiltered,
            "total_fee" => $totalFee,
            "total_ticket" => $totalTicket,
            "total_profit" => $totalProfit,
            "total_pull_out" => $totalPullOut,
            "total_pull_out_capital" => $totalPullOutCapital,
            "total_amt" => $totalAmount,
            "data" => $data
        ]);
    }
    public function add_pull_out()
    {
        $total_pull_out = $this->input->post('total_amt');
        $process_fee = $this->input->post('process_fee');
        $ticket = $this->input->post('ticket');
        $profit_share = $this->input->post('profit');
        $pull_out = $this->input->post('pull_out');
        $pull_out_capital = $this->input->post('pull_out_capital');

        $pull_out_details = [
            'process_fee' => $process_fee,
            'ticket' => $ticket,
            'profit_share' => $profit_share,
            'pull_out' => $pull_out,
            'pull_out_capital' => $pull_out_capital,
            'total_pull_out' => $total_pull_out,
            'date_added' => $this->input->post('date_added'),
        ];

        $total_pull_out = $this->input->post('total_amt');

        $inserted = $this->db->insert('tbl_pull_out', $pull_out_details);

        // $this->db->set('pull_out_bal', 'pull_out_bal + ' . $total_pull_out, FALSE)
        //     ->where('id', 1)
        //     ->update('tbl_balance');

        if ($inserted) {
            $this->db->set('processing_fee', 'processing_fee + ' . $process_fee, FALSE);
            $this->db->set('ticket', 'ticket + ' . $ticket, FALSE);
            $this->db->set('profit', 'profit + ' . $profit_share, FALSE);
            $this->db->set('expansion', 'expansion + ' . $pull_out, FALSE);
            $this->db->set('capital', 'capital + ' . $pull_out_capital, FALSE);
            $this->db->set('pull_out_bal', 'pull_out_bal + ' . $total_pull_out, FALSE);
            $this->db->where('id', 1);
            $this->db->update('tbl_balance');
        }

        if (!$inserted) {
            echo json_encode([
                'status' => 'error',
                'message' => 'Failed to add pull out record.'
            ]);
        } else {
            echo json_encode([
                'status' => 'success',
                'message' => 'Pull out saved successfully.',
            ]);
        }
    }

    public function update_pull_out($id)
    {
        // Get old record
        $old_record = $this->db->select('process_fee, ticket, profit_share, pull_out, pull_out_capital, total_pull_out')
            ->where('id', $id)
            ->get('tbl_pull_out')
            ->row();

        if (!$old_record) {
            echo json_encode([
                'status' => 'error',
                'message' => 'Record not found.'
            ]);
            return;
        }

        // Mapping: pull_out column -> balance column
        $field_mapping = [
            'process_fee' => 'processing_fee',
            'ticket' => 'ticket',
            'profit_share' => 'profit',
            'pull_out' => 'expansion',
            'pull_out_capital' => 'capital',
            'total_pull_out' => 'pull_out_bal'
        ];

        // Special mapping for POST fields (some have different names)
        $post_mapping = [
            'process_fee' => 'process_fee',
            'ticket' => 'ticket',
            'profit_share' => 'profit',
            'pull_out' => 'pull_out',
            'pull_out_capital' => 'pull_out_capital',
            'total_pull_out' => 'total_amt'  // Special case
        ];

        $pull_out_details = [];
        $differences = [];

        foreach ($field_mapping as $pull_field => $balance_field) {
            // Get the POST field name
            $post_field = $post_mapping[$pull_field];

            // Get new value from POST
            $new_value = (float) $this->input->post($post_field) ?: 0;
            $old_value = (float) $old_record->$pull_field ?: 0;
            $difference = $new_value - $old_value;

            $pull_out_details[$pull_field] = $new_value;
            $differences[$balance_field] = $difference;
        }

        // Add date_added
        $pull_out_details['date_added'] = $this->input->post('date_added');

        // Start transaction
        $this->db->trans_start();

        // Update pull out record
        $this->db->where('id', $id);
        $updated = $this->db->update('tbl_pull_out', $pull_out_details);

        if ($updated) {
            // Update balance table
            foreach ($differences as $balance_field => $difference) {
                if ($difference != 0) {
                    $this->db->set($balance_field, "{$balance_field} + {$difference}", FALSE);
                }
            }

            $this->db->where('id', 1);
            $this->db->update('tbl_balance');
        }

        $this->db->trans_complete();

        if ($this->db->trans_status() === FALSE || !$updated) {
            echo json_encode([
                'status' => 'error',
                'message' => 'Failed to update pull out record.'
            ]);
        } else {
            echo json_encode([
                'status' => 'success',
                'message' => 'Pull out data updated successfully.',
            ]);
        }
    }

    public function delete_id()
    {
        $id = $this->input->post('id');

        // Get the full record before deleting/archiving
        $record = $this->db->select('process_fee, ticket, profit_share, pull_out, pull_out_capital, total_pull_out')
            ->where('id', $id)
            ->get('tbl_pull_out')
            ->row();

        if (!$record) {
            echo json_encode([
                'status' => 'error',
                'message' => 'Record not found.'
            ]);
            return;
        }

        // Get all values from the record
        $process_fee = (float) $record->process_fee ?: 0;
        $ticket = (float) $record->ticket ?: 0;
        $profit_share = (float) $record->profit_share ?: 0;
        $pull_out = (float) $record->pull_out ?: 0;
        $pull_out_capital = (float) $record->pull_out_capital ?: 0;
        $total_pull_out = (float) $record->total_pull_out ?: 0;

        // Soft delete - set status to 1 (archived/deleted)
        $data = [
            'status' => "1"
        ];

        // Start transaction
        $this->db->trans_start();

        // Update the pull out record (soft delete)
        $this->db->where('id', $id);
        $updated = $this->db->update('tbl_pull_out', $data);

        if ($updated) {
            // Subtract all amounts from balance table
            $this->db->set('processing_fee', 'processing_fee - ' . $process_fee, FALSE);
            $this->db->set('ticket', 'ticket - ' . $ticket, FALSE);
            $this->db->set('profit', 'profit - ' . $profit_share, FALSE);
            $this->db->set('expansion', 'expansion - ' . $pull_out, FALSE);
            $this->db->set('capital', 'capital - ' . $pull_out_capital, FALSE);
            $this->db->set('pull_out_bal', 'pull_out_bal - ' . $total_pull_out, FALSE);
            $this->db->where('id', 1);
            $this->db->update('tbl_balance');
        }

        // Complete transaction
        $this->db->trans_complete();

        if ($this->db->trans_status() === FALSE || !$updated) {
            echo json_encode([
                'status' => 'error',
                'message' => 'Failed to delete pull out record.'
            ]);
        } else {
            echo json_encode([
                'status' => 'success',
                'message' => 'Pull out data deleted successfully.',
            ]);
        }
    }

    public function get_total_pullout()
    {
        $this->db->select('*');
        $query = $this->db->get('tbl_balance');
        $result = $query->row();
        echo json_encode([
            'processing_fee' => $result->processing_fee ?? 0,
            'ticket' => $result->ticket ?? 0,
            'profit' => $result->profit ?? 0,
            'expansion' => $result->expansion ?? 0,
            'capital' => $result->capital ?? 0,
            'total_pullout' => $result->pull_out_bal ?? 0
        ]);
    }

    public function add_withdrawal()
    {
        $total_pullout = floatval($this->input->post('total_pullout'));
        $amount = floatval($this->input->post('amount'));
        $notes = $this->input->post('notes');
        $category = $this->input->post('category');
        $date_added = $this->input->post('date');

        // Validate category
        $allowed_categories = ['processing_fee', 'ticket', 'profit', 'expansion', 'capital'];
        if (!in_array($category, $allowed_categories)) {
            echo json_encode([
                'status' => 'error',
                'message' => 'Invalid withdrawal category.'
            ]);
            return;
        }

        // Validate amount
        if ($amount <= 0) {
            echo json_encode([
                'status' => 'error',
                'message' => 'Invalid withdrawal amount.'
            ]);
            return;
        }

        // Get current balance record
        $balance = $this->db->get_where('tbl_balance', ['id' => 1])->row();

        if (!$balance) {
            echo json_encode([
                'status' => 'error',
                'message' => 'Balance record not found.'
            ]);
            return;
        }

        // Get the current balance of the selected category
        $current_category_balance = 0;
        $category_label = '';
        switch ($category) {
            case 'processing_fee':
                $current_category_balance = floatval($balance->processing_fee);
                $category_label = 'Processing Fee';
                break;
            case 'ticket':
                $current_category_balance = floatval($balance->ticket);
                $category_label = 'Ticket';
                break;
            case 'profit':
                $current_category_balance = floatval($balance->profit);
                $category_label = 'Profit';
                break;
            case 'expansion':
                $current_category_balance = floatval($balance->expansion);
                $category_label = 'Expansion';
                break;
            case 'capital':
                $current_category_balance = floatval($balance->capital);
                $category_label = 'Capital';
                break;
        }

        // Check if the amount is equal to or less than the category balance
        if ($amount > $current_category_balance) {
            echo json_encode([
                'status' => 'error',
                'message' => 'Insufficient ' . $category_label . ' balance. Available: ₱' . number_format($current_category_balance, 2) . ', Requested: ₱' . number_format($amount, 2)
            ]);
            return; // Exit the function immediately
        }

        // Insert withdrawal record with category
        $withdrawal_details = [
            'withdraw_amt' => $amount,
            'note' => $notes,
            'category' => $category,
            'date_added' => $date_added
        ];

        $inserted = $this->db->insert('tbl_withdrawal', $withdrawal_details);

        if (!$inserted) {
            echo json_encode([
                'status' => 'error',
                'message' => 'Failed to add withdrawal record.'
            ]);
            return;
        }

        // Prepare update data based on category
        $update_data = [];

        switch ($category) {
            case 'processing_fee':
                $update_data['processing_fee'] = $current_category_balance - $amount;
                break;
            case 'ticket':
                $update_data['ticket'] = $current_category_balance - $amount;
                break;
            case 'profit':
                $update_data['profit'] = $current_category_balance - $amount;
                break;
            case 'expansion':
                $update_data['expansion'] = $current_category_balance - $amount;
                break;
            case 'capital':
                $update_data['capital'] = $current_category_balance - $amount;
                break;
        }

        // Also update the pull_out_bal (total withdrawal balance)
        $update_data['pull_out_bal'] = floatval($balance->pull_out_bal) - $amount;

        // Update the specific column and pull_out_bal
        $this->db->where('id', 1);
        $this->db->update('tbl_balance', $update_data);

        if ($this->db->affected_rows() > 0) {
            echo json_encode([
                'status' => 'success',
                'message' => 'Withdrawal saved successfully.',
                'category' => $category,
                'category_label' => $category_label,
                'deducted_amount' => $amount,
                'new_balance' => $update_data['pull_out_bal'],
                'new_category_balance' => $update_data[$category]
            ]);
        } else {
            echo json_encode([
                'status' => 'error',
                'message' => 'Failed to update balance.'
            ]);
        }
    }

    public function get_withdrawal_history()
    {
        // Get all withdrawals ordered by date (latest first)
        $withdrawals = $this->db->select('*')
            ->from('tbl_withdrawal')
            ->order_by('date_added', 'DESC')
            ->get()
            ->result();

        if (empty($withdrawals)) {
            echo json_encode([
                'status' => 'success',
                'data' => [],
                'total' => 0,
                'count' => 0
            ]);
            return;
        }

        // Calculate total
        $total = 0;
        foreach ($withdrawals as $w) {
            $total += floatval($w->withdraw_amt);
        }

        echo json_encode([
            'status' => 'success',
            'data' => $withdrawals,
            'total' => number_format($total, 2),
            'count' => count($withdrawals)
        ]);
    }

    public function update_withdrawal()
    {
        $id = $this->input->post('id');
        $amount = floatval($this->input->post('amount'));
        $category = $this->input->post('category');
        $notes = $this->input->post('notes');

        // Validate inputs
        if ($amount <= 0) {
            echo json_encode(['status' => 'error', 'message' => 'Invalid withdrawal amount. Amount must be greater than 0.']);
            return;
        }

        // Get old withdrawal data
        $old = $this->db->get_where('tbl_withdrawal', ['id' => $id])->row();

        if (!$old) {
            echo json_encode(['status' => 'error', 'message' => 'Withdrawal record not found.']);
            return;
        }

        // Check if category is valid
        $allowed_categories = ['processing_fee', 'ticket', 'profit', 'expansion', 'capital'];
        if (!in_array($category, $allowed_categories)) {
            echo json_encode(['status' => 'error', 'message' => 'Invalid category selected.']);
            return;
        }

        // Start transaction
        $this->db->trans_begin();

        try {
            // Get current balance
            $balance = $this->db->get_where('tbl_balance', ['id' => 1])->row();

            if (!$balance) {
                throw new Exception('Balance record not found.');
            }

            // Check if old category balance exists
            if (!property_exists($balance, $old->category)) {
                throw new Exception('Old category balance not found.');
            }

            // Check if new category balance exists
            if (!property_exists($balance, $category)) {
                throw new Exception('New category balance not found.');
            }

            // Validate based on category change
            if ($old->category !== $category) {
                // Different category - check new category balance
                $new_category_balance = floatval($balance->{$category});
                if ($amount > $new_category_balance) {
                    throw new Exception(
                        'Insufficient balance in ' . ucfirst(str_replace('_', ' ', $category)) .
                        '. Available: ₱' . number_format($new_category_balance, 2) .
                        ', Requested: ₱' . number_format($amount, 2)
                    );
                }
            } else {
                // Same category - check if available after adding back old amount
                $current_category_balance = floatval($balance->{$category});
                $available_balance = $current_category_balance + floatval($old->withdraw_amt);

                if ($amount > $available_balance) {
                    throw new Exception(
                        'Insufficient balance in ' . ucfirst(str_replace('_', ' ', $category)) .
                        '. Available: ₱' . number_format($available_balance, 2) .
                        ', Requested: ₱' . number_format($amount, 2)
                    );
                }
            }

            // Step 1: Return old amount to old category
            $old_category_balance = floatval($balance->{$old->category});
            $update_data = [
                $old->category => $old_category_balance + floatval($old->withdraw_amt)
            ];
            $this->db->where('id', 1)->update('tbl_balance', $update_data);

            if ($this->db->affected_rows() < 0) {
                throw new Exception('Failed to return old amount.');
            }

            // Step 2: Update withdrawal record
            $update_withdrawal = [
                'withdraw_amt' => $amount,
                'category' => $category,
                'note' => $notes
            ];
            $this->db->where('id', $id)->update('tbl_withdrawal', $update_withdrawal);

            if ($this->db->affected_rows() < 0) {
                throw new Exception('Failed to update withdrawal record.');
            }

            // Step 3: Deduct new amount from new category
            $balance = $this->db->get_where('tbl_balance', ['id' => 1])->row();
            $new_category_balance = floatval($balance->{$category});
            $update_data = [
                $category => $new_category_balance - $amount
            ];
            $this->db->where('id', 1)->update('tbl_balance', $update_data);

            if ($this->db->affected_rows() < 0) {
                throw new Exception('Failed to deduct new amount.');
            }

            // Commit transaction
            $this->db->trans_commit();

            echo json_encode([
                'status' => 'success',
                'message' => 'Withdrawal updated successfully.',
                'data' => [
                    'id' => $id,
                    'amount' => $amount,
                    'category' => $category,
                    'old_category' => $old->category
                ]
            ]);

        } catch (Exception $e) {
            // Rollback transaction on error
            $this->db->trans_rollback();
            echo json_encode([
                'status' => 'error',
                'message' => $e->getMessage()
            ]);
        }
    }

    public function delete_withdrawal()
    {
        $id = $this->input->post('id');
        $amount = floatval($this->input->post('amount'));
        $category = $this->input->post('category');

        // Get the withdrawal record to check status
        $withdrawal = $this->db->get_where('tbl_withdrawal', ['id' => $id])->row();

        if (!$withdrawal) {
            echo json_encode(['status' => 'error', 'message' => 'Withdrawal record not found']);
            return;
        }

        // Start transaction
        $this->db->trans_begin();

        try {
            // Only return amount if status is 0 (active)
            if ($withdrawal->status == 0) {
                // Get current balance
                $balance = $this->db->get_where('tbl_balance', ['id' => 1])->row();

                if (!$balance) {
                    throw new Exception('Balance record not found');
                }

                // Return amount to category balance and update pull_out_bal
                $update_data = [
                    $category => floatval($balance->{$category}) + $amount,
                    'pull_out_bal' => floatval($balance->pull_out_bal) + $amount
                ];
                $this->db->where('id', 1)->update('tbl_balance', $update_data);
            }

            // Delete the withdrawal record
            $this->db->where('id', $id)->delete('tbl_withdrawal');

            $this->db->trans_commit();

            echo json_encode([
                'status' => 'success',
                'message' => $withdrawal->status == 0 ?
                    'Withdrawal deleted successfully and amount returned to balance' :
                    'Withdrawal deleted successfully (no balance adjustment needed)'
            ]);

        } catch (Exception $e) {
            $this->db->trans_rollback();
            echo json_encode([
                'status' => 'error',
                'message' => $e->getMessage()
            ]);
        }
    }

    public function return_withdrawal()
    {
        $id = $this->input->post('id');
        $amount = floatval($this->input->post('amount'));
        $category = $this->input->post('category');

        // Get the withdrawal record to check status
        $withdrawal = $this->db->get_where('tbl_withdrawal', ['id' => $id])->row();

        if (!$withdrawal) {
            echo json_encode(['status' => 'error', 'message' => 'Withdrawal record not found']);
            return;
        }

        // Check if already returned
        if ($withdrawal->status == 1) {
            echo json_encode(['status' => 'error', 'message' => 'This withdrawal has already been returned']);
            return;
        }

        // Start transaction
        $this->db->trans_begin();

        try {
            // Get current balance
            $balance = $this->db->get_where('tbl_balance', ['id' => 1])->row();

            if (!$balance) {
                throw new Exception('Balance record not found');
            }

            // Return amount to category balance
            $update_data = [
                $category => floatval($balance->{$category}) + $amount,
                'pull_out_bal' => floatval($balance->pull_out_bal) + $amount  // Also update pull_out_bal
            ];
            $this->db->where('id', 1)->update('tbl_balance', $update_data);

            // Mark withdrawal as returned
            $this->db->where('id', $id)->update('tbl_withdrawal', [
                'status' => '1',
            ]);

            $this->db->trans_commit();

            echo json_encode([
                'status' => 'success',
                'message' => 'Amount returned successfully to ' . ucfirst(str_replace('_', ' ', $category))
            ]);

        } catch (Exception $e) {
            $this->db->trans_rollback();
            echo json_encode([
                'status' => 'error',
                'message' => $e->getMessage()
            ]);
        }
    }
}