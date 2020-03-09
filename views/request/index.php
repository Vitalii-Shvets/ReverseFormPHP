<?php include ROOT . '/views/layouts/header.php'; ?>

<?php if (isset($error) && count($error)): ?>
    <?php foreach ($error as $err): ?>
        <p class="err"><?php echo $err; ?></p>
    <?php endforeach; ?>
<?php endif; ?>

<form method="POST" name="dataForm" enctype="multipart/form-data" action="request">
    <p>
    <h1>Form</h1></p>
    <input type="text" id="fname" name="fname" placeholder="Enter first name"><em>*</em><br><br>
    <input type="text" id="lname" name="lname" placeholder="Enter last name"><br><br>
    <input type="email" id="email" name="email" placeholder="Enter email"><br><br>
    <input type="tel" id="tel" name="tel" placeholder="Enter telephone"><em>*</em><br><br>
    <input id="picture" name="picture" type="file"><em>*</em><br><br>
    <input class="bt" type="submit" value="Submit">
</form>

<table border="1" width="100%">
    <tr id="sort-col">
        <th class="cross" data-id="fname">First name</th>
        <th class="cross" data-id="lname">Last name</th>
        <th class="cross" data-id="email">Email</th>
        <th class="cross" data-id="tel">Phone</th>
        <th>Image</th>
        <th>Action</th>

    </tr>
    <tbody class="table-wrapper">
    <?php include ROOT . '/views/components/table.php'; ?>
    </tbody>
</table>


<?php include ROOT . '/views/layouts/footer.php'; ?>
