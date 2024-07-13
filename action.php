<?php

require_once 'db.php';
$db = new Database();

// View Users
if (isset($_POST['action']) && $_POST['action'] == 'view') {
    $output = '';
    $data = $db->read();
    if ($db->totalRowCount() > 0) {
        $output .= '<table class="table table-striped table-sm table-bordered text-center">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>First Name</th>
                                <th>Last Name</th>
                                <th>E-Mail</th>
                                <th>Phone</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>';
        foreach ($data as $row) {
            $output .= '<tr class="text-center text-secondary">
                                <td>' . htmlspecialchars($row['id']) . '</td>
                                <td>' . htmlspecialchars($row['first_name']) . '</td>
                                <td>' . htmlspecialchars($row['last_name']) . '</td>
                                <td>' . htmlspecialchars($row['email']) . '</td>
                                <td>' . htmlspecialchars($row['phone']) . '</td>
                                <td>
                                    <a href="#" title="View Details" class="text-success infoBtn" id="' . htmlspecialchars($row['id']) . '"><i class="fas fa-info-circle fa-lg"></i></a>&nbsp; &nbsp;
                                    <a href="#" title="Edit" class="text-primary editBtn" data-toggle="modal" data-target="#editModel" id="' . htmlspecialchars($row['id']) . '"><i class="fas fa-edit fa-lg"></i></a>&nbsp; &nbsp;
                                    <a href="#" title="Delete" class="text-danger delBtn" id="' . htmlspecialchars($row['id']) . '"><i class="fas fa-trash-alt fa-lg"></i></a>
                                </td>
                            </tr>';
        }
        $output .= '</tbody></table>';
        echo $output;
    } else {
        echo '<h3 class="text-center text-secondary mt-5">:) No Users in the Database!</h3>';
    }
}

// Insert User
if (isset($_POST['action']) && $_POST['action'] == "insert") {
    $fname = filter_input(INPUT_POST, 'fname', FILTER_SANITIZE_STRING);
    $lname = filter_input(INPUT_POST, 'lname', FILTER_SANITIZE_STRING);
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
    $phone = filter_input(INPUT_POST, 'phone', FILTER_SANITIZE_STRING);

    if ($db->insert($fname, $lname, $email, $phone)) {
        echo 'User inserted successfully';
    } else {
        echo 'Failed to insert user';
    }
}

// Get User by ID
if (isset($_POST['edit_id'])) {
    $id = filter_input(INPUT_POST, 'edit_id', FILTER_SANITIZE_NUMBER_INT);
    $row = $db->getUserById($id);
    echo json_encode($row);
}

// Update User
if (isset($_POST['action']) && $_POST['action'] == "update") {
    $id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT);
    $fname = filter_input(INPUT_POST, 'fname', FILTER_SANITIZE_STRING);
    $lname = filter_input(INPUT_POST, 'lname', FILTER_SANITIZE_STRING);
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
    $phone = filter_input(INPUT_POST, 'phone', FILTER_SANITIZE_STRING);

    if ($db->update($id, $fname, $lname, $email, $phone)) {
        echo 'User updated successfully';
    } else {
        echo 'Failed to update user';
    }
}

// Delete User
if (isset($_POST['del_id'])) {
    $id = filter_input(INPUT_POST, 'del_id', FILTER_SANITIZE_NUMBER_INT);
    if ($db->delete($id)) {
        echo 'User deleted successfully';
    } else {
        echo 'Failed to delete user';
    }
}

// Get User Info
if (isset($_POST['info_id'])) {
    $id = filter_input(INPUT_POST, 'info_id', FILTER_SANITIZE_NUMBER_INT);
    $row = $db->getUserById($id);
    echo json_encode($row);
}

// Export to Excel
if (isset($_GET['export']) && $_GET['export'] == "excel") {
    header("Content-Type: application/xls");
    header("Content-Disposition: attachment; filename=users.xls");
    header("Pragma: no-cache");
    header("Expires: 0");

    $data = $db->read();
    echo '<table border="1">';
    echo '<tr><th>ID</th><th>First Name</th><th>Last Name</th><th>Email</th><th>Phone</th></tr>';
    foreach ($data as $row) {
        echo '<tr>
                <td>' . htmlspecialchars($row['id']) . '</td>
                <td>' . htmlspecialchars($row['first_name']) . '</td>
                <td>' . htmlspecialchars($row['last_name']) . '</td>
                <td>' . htmlspecialchars($row['email']) . '</td>
                <td>' . htmlspecialchars($row['phone']) . '</td>
        </tr>';
    }
    echo '</table>';
}
?>
