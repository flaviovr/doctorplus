<!-- File: src/Template/Users/index.ctp (delete links added) -->
<div class="container">
    <div class="row">   
        <h1>Users</h1>
        <p><?= $this->Html->link('Incluir Usuário', ['action' => 'add']) ?></p>
        <table>
            <tr>
                <th>Id</th>
                <th>Title</th>
                <th>Actions</th>
            </tr>

        <!-- Here's where we loop through our $articles query object, printing out article info -->

            <?php foreach ($users as $user): ?>
            <tr>
                <td><?= $user->id ?></td>
                <td><?= $user->username?></td>
                <td>
                    <?= $this->Form->postLink(
                        'Delete',
                        ['action' => 'delete', $user->id],
                        ['confirm' => 'Are you sure?'])
                    ?>
                    <?= $this->Html->link('Edit', ['action' => 'edit', $user->id]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
            
        </table>
    </div>
</div>
