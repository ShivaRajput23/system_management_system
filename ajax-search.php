<?php
include "config/connection.php";
if (!isset($_SESSION['login'])) {
    header("location:login.php");
    exit;
  }

$search_value=$_POST["search"];
// $sql_search="SELECT * FROM inventories i LEFT JOIN data d ON i.system_id=d.system_id WHERE d.system_no LIKE '%{$search_value}%' OR i.product_no LIKE '%{$search_value}%' OR i.type LIKE '%{$search_value}%' OR i.name LIKE '%{$search_value}%'
// ORDER BY i.system_id ASC" ;
// $data=mysqli_query($conn,$sql_search);

$sql="SELECT inventories.*, data.system_no, types.type AS type_name
FROM inventories
LEFT JOIN data ON inventories.system_id=data.system_id
LEFT JOIN types ON inventories.type=types.id
WHERE data.system_no LIKE '%{$search_value}%' OR inventories.product_no LIKE '%{$search_value}%' OR inventories.type LIKE '%{$search_value}%' OR inventories.name LIKE '%{$search_value}%'
ORDER BY inventories.system_id ASC;" ;
$data=mysqli_query($conn,$sql);


$inv_list_arr=[];
while($row = mysqli_fetch_assoc($data)) {
    $inv_list_arr[]=$row;
}

?>         
        <!-- TABLE: LATEST ORDERS -->
<table id="table-data" class="table m-0">
    <thead>
        <tr>
            <th>System NO.</th>
            <th>Product Name</th>
            <th>Product No.</th>
            <th>Product Type</th>
            <th>Status</th>
            <th>Action</th>
            
        </tr>
    </thead>
    <?php
        if (count($inv_list_arr)>0) {
    ?>
    <tbody>
        <?php foreach($inv_list_arr as $row) {?>
            <tr>
                                                
                <td ><?= $row['system_no'] ?></td>
                <td><?= $row['name'] ?></td>
                <td><?= $row['product_no'] ?></td>

                <td><?= $row['type_name'] ?></td>

                <td><?php
                    if($row['status']==0){
                        echo "<span class='badge badge-warning'>Replacement</span>";
                    }
                    if($row['status']==1){
                        echo "<span class='badge badge-success'>Active</span>";
                    }
                    if($row['status']==2){
                        echo "<span class='badge badge-danger'>Dead</span>";
                    }
                ?></td>
                <td>
                    <div class="sparkbar" data-color="#00a65a" data-height="20">
                        <div class="btn-group">
                            <button type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#modal-default-details-<?= $row['id'] ?>">
                                <i class="fas fa-eye"></i>
                            </button>
                            <a class="btn btn-primary btn-sm" href='crud/edit_inventories.php?id=<?= $row['id']?> && system_no=<?= $row['system_no']?>'>
                                <i class="fas fa-edit"></i>
                            </a>
                            <a class="btn btn-danger btn-sm"  onclick="return confirm('Are you sure?')" href='crud/delete_inventories.php?id=<?= $row['id']?>'>
                                <i class="fas fa-trash-alt"></i>
                            </a>
                        </div>  
                        <a class="btn btn-secondary btn-sm p-1" href='crud/logs.php?id=<?= $row['id']?>'>
                            <i>Logs</i>
                        </a>  
                        <!-- <select style="padding:5px;" class="btn btn-dark btn-sm " onchange="status_update(this.options[this.selectedIndex].value,'<?php echo $row['id']?>')">  
                            <option value="" >Update Status</option>  
                            <option value="0" >Replacement</option>  
                            <option value="1">Active</option>  
                            <option value="2">Dead</option>  
                        </select>  -->
                        
                        <div class="btn-group">
                            <button type="button" class="btn btn-sm btn-dark dropdown-toggle dropdown-icon" data-toggle="dropdown">
                                Update Status<span class="sr-only">Toggle Dropdown</span>
                            </button>
                            <div class="dropdown-menu" role="menu">
                                <button type="button" class="dropdown-item btn-sm" data-toggle="modal" data-target="#modal-default-replacement-<?= $row['id']?>">
                                    Replacement
                                </button>
                                <button type="button" class="dropdown-item btn-sm " data-toggle="modal" data-target="#modal-default-dead-<?= $row['id']?>">
                                    Dead
                                </button>
                                <form action="" method="post">
                                    <button type="submit" name="active" class="dropdown-item btn-sm">
                                        Active
                                        <input type="hidden" name="active_status" value="<?= $row['id']?>">

                                    </button>
                                </form>
                            </div>
                        </div> 
                        
                    </div>
                </td>
            </tr>
        <?php } } ?>
    </tbody>
</table>
