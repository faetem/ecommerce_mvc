<div style="max-width: 600px; margin: 40px auto; padding: 20px; border: 1px solid #ddd; border-radius: 4px; font-family: sans-serif; background-color: #fff;">
    <h2 style="margin-top: 0; color: #333; border-bottom: 1px solid #eee; padding-bottom: 10px;">Modifier l'utilisateur #<?= $user['id'] ?></h2>

    <form method="POST" action="/admin/edit-user" style="display: flex; flex-direction: column; gap: 15px; margin-top: 20px;">
        <input type="hidden" name="id" value="<?= $user['id'] ?>">

        <div>
            <label style="display: block; margin-bottom: 5px; font-weight: bold;">Nom :</label>
            <input type="text" name="nom" value="<?= htmlspecialchars($user['nom']) ?>" required 
                   style="width: 100%; padding: 8px; border: 1px solid #ccc; border-radius: 4px; box-sizing: border-box;">
        </div>

        <div>
            <label style="display: block; margin-bottom: 5px; font-weight: bold;">Email :</label>
            <input type="email" name="email" value="<?= htmlspecialchars($user['email']) ?>" required 
                   style="width: 100%; padding: 8px; border: 1px solid #ccc; border-radius: 4px; box-sizing: border-box;">
        </div>

        <div>
            <label style="display: block; margin-bottom: 5px; font-weight: bold;">Rôle :</label>
            <select name="role" style="width: 100%; padding: 8px; border: 1px solid #ccc; border-radius: 4px; background-color: white;">
                <option value="ROLE_USER" <?= $user['role'] === 'ROLE_USER' ? 'selected' : '' ?>>Utilisateur Standard</option>
                <option value="ROLE_ADMIN" <?= $user['role'] === 'ROLE_ADMIN' ? 'selected' : '' ?>>Administrateur</option>
            </select>
        </div>

        <div style="display: flex; gap: 10px; margin-top: 10px;">
            <button type="submit" style="flex: 1; padding: 10px; background-color: #28a745; color: white; border: none; border-radius: 4px; cursor: pointer; font-size: 16px;">
                Enregistrer les modifications
            </button>
            <a href="/admin/users" style="flex: 1; padding: 10px; background-color: #6c757d; color: white; text-decoration: none; text-align: center; border-radius: 4px; font-size: 16px;">
                Annuler
            </a>
        </div>
    </form>
</div>