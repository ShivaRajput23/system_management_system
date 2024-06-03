<?php
include "config/connection.php";
if (!isset($_SESSION['login'])) {
    header("location:login.php");
    exit;
  }

$search_value=$_POST["search"];
$sql="SELECT * FROM employee e LEFT JOIN data d ON e.system_id=d.system_id WHERE e.employee_name LIKE '%{$search_value}%' OR  e.emp_phone_no LIKE '%{$search_value}%' OR  e.emp_email LIKE '%{$search_value}%' OR d.system_no LIKE '%{$search_value}%'
ORDER BY e.system_id ASC";


$data=mysqli_query($conn,$sql);
$rows=mysqli_num_rows($data);
if (!$data) {
    die ("not connected" .mysqli_error());

}
    
?>
<table class="table m-0" id="table-data">
    <thead>
        <tr>
            <th>ID</th>
            <th>System NO.</th>
            <th>Name</th>
            <th>Phone</th>
            <th>Email</th>
            <th>Shift</th>
            <th>Action</th>
        </tr>
    </thead>
    <?php if ($rows!=0) {?>
    <tbody>
        <?php while($row = mysqli_fetch_assoc($data)) {?>
            <tr>
                <td><?= $row['id'] ?></td>
                <td><?= $row['system_no']?></td>
                <td><?= $row['employee_name'] ?></td>
                <td><?= $row['emp_phone_no'] ?></td>
                <td><?= $row['emp_email'] ?></td>
                <td><?php
                        if($row['shift']==1){
                            echo "Day";
                        }
                        if($row['shift']==2){
                            echo "Night";
                        }
                    ?></td>
                <td>
                    <div class="sparkbar" data-color="#00a65a" data-height="20">
                        <div class="btn-group">
                            <a class="btn btn-primary btn-sm" href='crud/edit_employee.php?id=<?= $row['id']?>'>
                                <i class="fas fa-edit"></i>
                            </a>
                            <a class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')" href='crud/delete_employee.php?id=<?= $row['id']?>'>
                                <i class="fas fa-trash-alt"></i>
                            </a>
                        </div>
                    </div>
                </td>
            </tr>
        <?php } } ?>
    </tbody>
</table>
