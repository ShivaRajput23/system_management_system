  <?php
include "config/connection.php";
if (!isset($_SESSION['login'])) {
    header("location:login.php");
    exit;
}
$search_value=$_POST["search"];
$sql="SELECT * FROM employee RIGHT JOIN data ON data.system_id = employee.system_id WHERE data.system_no LIKE '%{$search_value}%' OR employee.employee_name LIKE '%{$search_value}%' ORDER BY data.system_no ASC" ;
$data=mysqli_query($conn,$sql);
$rows=mysqli_num_rows($data);
if (!$data) {
    die ("not connected" .mysqli_error());
}    
?>

<table class="table m-0" id="table-data">
    <thead>
        <tr>
            <th>System No.</th>
            <th>Assigned To</th>
            <th>Operating System</th>
            <th>Action</th>
        </tr>
    </thead>
    <?php
        if ($rows!=0) {
    ?>
    <tbody>
        <?php while($row = mysqli_fetch_assoc($data)) {?>
            <tr>
                <td><?= $row['system_no'] ?></td>
                    <td><?php 
                    if($row['employee_name']==""){
                        echo "not assigned";

                    } 
                    else{
                        echo  $row['employee_name'];
                    }
                    ?>
                </td>
                <td><?= $row['operating_system'] ?></td>
                <td>
                    <div class="btn-group">
                        <a class="btn btn-warning btn-sm" href='notes.php?id=<?= $row['system_no']?>'>
                            <i class="fas fa-eye"></i>
                        </a>
                        <a class="btn btn-danger btn-sm"  onclick="return confirm('Are you sure?')" href='crud/delete.php?id=<?= $row['system_id']?>'>
                            <i class="fas fa-trash-alt"></i>
                        </a>
                    </div>
                </td>
            </tr>
        <?php } } ?>
    </tbody>
</table>
