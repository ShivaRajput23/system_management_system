<?php
include "config/connection.php";
if (!isset($_SESSION['login'])) {
    header("location:login.php");
    exit;
}

$search_value=$_POST["search"];
$sql="SELECT * FROM data WHERE system_no LIKE '%{$search_value}%' OR cpu_no LIKE '%{$search_value}%' ORDER BY data.system_no ASC" ;

$data=mysqli_query($conn,$sql);
$rows=mysqli_num_rows($data);
if (!$data) {
    die ("not connected" .mysqli_error());

}
    
?>
<table class="table m-0" id="table-data">
    <thead>
        <tr>
            <th>System NO.</th>
            <th>Cpu</th>
            <th>Ram Slot</th>
            <th>Operating System</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        <?php if ($rows!=0) { ?>
        <?php while($row = mysqli_fetch_assoc($data)) {?>
            <tr>
                
                <td><?= $row['system_no'] ?></td>
                <td><?= $row['cpu_no'] ?></td>
                <td><?= $row['ram_slot'] ?></td>
                <td><?= $row['operating_system'] ?></td>
                <td>
                    <div class="btn-group">
                        <a class="btn btn-warning btn-sm" href='notes.php?id=<?= $row['system_no']?>'>
                            <i class="fas fa-eye"></i>
                        </a>
                        <a class="btn btn-primary btn-sm" href='crud/edit_systemdata.php?id=<?= $row['system_no']?>'>
                            <i class="fas fa-edit"></i>
                        </a>
                        <a class="btn btn-danger btn-sm"  onclick="return confirm('Are you sure?')" href='crud/delete_systemdata.php?id=<?= $row['system_id']?>'>
                            <i class="fas fa-trash-alt"></i>
                        </a>
                    </div>
                </td>
            </tr>
        <?php } } ?>
    </tbody>
</table>

