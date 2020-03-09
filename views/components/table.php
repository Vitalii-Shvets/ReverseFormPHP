<?php foreach ($requests as $request): ?>
    <tr id="row-<?php echo $request['id']; ?>" align="center">
        <td><?php echo $request['fname']; ?></td>
        <td><?php echo $request['lname']; ?></td>
        <td><?php echo $request['email']; ?></td>
        <td><?php echo $request['tel']; ?></td>
        <td><img src="<?php echo $request['picture']; ?>" alt="<?php echo $request['picture']; ?>"></td>
        <td>
            <button class="bt bt-del" data-id="<?php echo $request['id']; ?>">delete</button>
        </td>
    </tr>
<?php endforeach; ?>


