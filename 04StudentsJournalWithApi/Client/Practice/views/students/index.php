<?php
use yii\widgets\LinkPager;
?>
<style>
    .active-page {
        background-color: #8fd1ff;
    }
    table, th, td {
        border: 1px solid black;
        border-collapse: collapse;
    }
    table {
        width: 100%;
    }
    th, td {
        //padding-left: 15px;
        padding: 25px;
    }
</style>

<h1 class="mt-5">This is a students journal</h1>

<!--message on success action -->
<?php if(Yii::$app->session->hasFlash('message')):?>
    <div class="alert alert-dismissible alert-success">
        <button type="button" class="close" data-dismiss="alert">&times;</button>
        <?php echo Yii::$app->session->getFlash('message');?>
    </div>
<?php endif;?>


<table>
    <tr>
        <th>Student</th>
        <th>Age</th>
        <th>Rating</th>
        <th>Group name</th>
    </tr>
    <?php foreach ($students as $student): ?>
        <tr>
            <td><?= $student->lastName ?> <?= $student->firstName ?></td>
            <td><?= $student->age ?></td>
            <td><?= $student->rating ?></td>
            <td><?= $student->groupName ?></td>
            <td><a href="edit-student?id=<?= $student->id ?>" class="btn btn-dark">Edit</a></td>
            <td><a href="delete-student?id=<?= $student->id ?>" class="btn btn-dark">Delete</a></td>
            <td><a href="show-student?id=<?= $student->id ?>" class="btn btn-dark">Show</a></td>
        </tr>
    <?php endforeach; ?>
</table>

<div class="text-center mt-5">
    <a href="add-student" class="btn btn-dark">Add new student</a>
</div>


