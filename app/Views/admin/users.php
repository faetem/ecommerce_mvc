<!-- <h1>Liste des utilisateurs</h1>

    <?php if (!empty($users)) : ?>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nom</th>
                    <th>Email</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($users as $user) : ?>
                    <tr>
                        <td><?= htmlspecialchars($user['id']) ?></td>
                        <td><?= htmlspecialchars($user['nom']) ?></td>
                        <td><?= htmlspecialchars($user['email']) ?></td>
                        <td>
                            <a class="btn" href="edit.php?id=<?= $user['id'] ?>">Modifier</a>
                            <a class="btn" href="delete.php?id=<?= $user['id'] ?>" onclick="return confirm('Supprimer cet utilisateur ?');">Supprimer</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php else : ?>
        <p>Aucun utilisateur trouvé.</p>
    <?php endif; ?> -->
<div style="max-width: 1000px; margin: 0 auto; padding: 20px; font-family: sans-serif;">
    
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
        <h2 style="color: #333;">Gestion des utilisateurs</h2>
        <a href="/admin" style="text-decoration: none; color: #007bff; font-size: 14px;">← Retour au Dashboard</a>
    </div>
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
        <a href="/admin/create-user" style="text-decoration: none; color: #007bff; font-size: 14px;">Créer un utilisateur</a>
    </div>

    <?php if (isset($message)): ?>
        <div style="padding: 10px; margin-bottom: 20px; border-radius: 4px; background-color: #d4edda; color: #155724; border: 1px solid #c3e6cb;">
            <?= htmlspecialchars($message) ?>
        </div>
    <?php endif; ?>

    <table style="width: 100%; border-collapse: collapse; background-color: white; box-shadow: 0 2px 4px rgba(0,0,0,0.1); border-radius: 8px; overflow: hidden;">
        <thead>
            <tr style="background-color: #f8f9fa; border-bottom: 2px solid #dee2e6;">
                <th style="padding: 12px; text-align: left; color: #495057;">ID</th>
                <th style="padding: 12px; text-align: left; color: #495057;">Nom</th>
                <th style="padding: 12px; text-align: left; color: #495057;">Email</th>
                <th style="padding: 12px; text-align: left; color: #495057;">Rôle</th>
                <th style="padding: 12px; text-align: center; color: #495057;">Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($users as $u): ?>
                <tr style="border-bottom: 1px solid #eee;">
                    <td style="padding: 12px; color: #666; font-size: 14px;"><?= $u['id'] ?></td>
                    <td style="padding: 12px; font-weight: bold; color: #333;"><?= htmlspecialchars($u['nom']) ?></td>
                    <td style="padding: 12px; color: #666;"><?= htmlspecialchars($u['email']) ?></td>
                    <td style="padding: 12px;">
                        <span style="padding: 4px 8px; border-radius: 4px; font-size: 12px; font-weight: bold; 
                            <?= $u['role'] === 'ROLE_ADMIN' ? 'background-color: #e3f2fd; color: #0d47a1;' : 'background-color: #f5f5f5; color: #616161;' ?>">
                            <?= $u['role'] ?>
                        </span>
                    </td>
                    <td style="padding: 12px; text-align: center;">
                        <div style="display: flex; gap: 8px; justify-content: center;">
                            <a href="/admin/edit-user?id=<?= $u['id'] ?>" 
                               style="padding: 5px 10px; background-color: #6c757d; color: white; text-decoration: none; border-radius: 4px; font-size: 12px;">
                                ✏️ Modifier
                            </a>
                            
                            <?php if ($u['id'] !== $_SESSION['user']['id']): ?>
                                <form method="POST" action="/admin/users/delete" onsubmit="return confirm('Supprimer cet utilisateur ?');" style="margin: 0;">
                                    <input type="hidden" name="id" value="<?= $u['id'] ?>">
                                    <button type="submit" style="padding: 5px 10px; background-color: #dc3545; color: white; border: none; border-radius: 4px; cursor: pointer; font-size: 12px;">
                                        🗑️
                                    </button>
                                </form>
                            <?php endif; ?>
                        </div>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>