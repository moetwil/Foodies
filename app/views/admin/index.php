<div class="container py-5">
    <div class="row py-5">
        <div class="col-12">
            <h1 class="text-center">Admin Panel</h1>
        </div>
    </div>
    <div id="usersContainer" class="row bg-white p-3 rounded">
        <div class="table-responsive">
        <table id="usersTable" class="table" >
            <thead>
                <tr>
                    <th scope="col">Id</th>
                    <th scope="col">Username</th>
                    <th scope="col">Email</th>
                    <th scope="col">Role</th>
                    <th scope="col">Edit</th>
                    <th scope="col">Delete</th>
                </tr>
            </thead>
            <tbody id="tableBody">
            </tbody>
        </table>
        </div>
    </div>      
</div>

<!-- Modal -->
<?php require_once('modal.php');?>

<script defer src="/js/admin.js"></script>
