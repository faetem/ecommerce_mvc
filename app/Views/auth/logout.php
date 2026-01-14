<!-- Formulaire d'inscription -->
<div style="max-width: 1200px; margin: 0 auto; padding: 20px;">
    <h2>Vous avez été déconnecté.</h2>

    <!-- Message de succès ou d'erreur -->
    <!-- <?php if (isset($message)): ?>
        <div style="padding: 10px; margin-bottom: 20px; border-radius: 4px; 
                    background-color: <?= isset($success) && $success ? '#d4edda' : '#f8d7da' ?>; 
                    color: <?= isset($success) && $success ? '#155724' : '#721c24' ?>;">
            <?= isset($success) && $success ? '✅ ' : '❌ ' ?><?= htmlspecialchars($message) ?>
        </div>
    <?php endif; ?> -->
    
    <!-- <form method="POST" action="/auth/login" style="display: flex; flex-direction: column; gap: 15px;"> -->
        <!-- <div>
            <label for="nom" style="display: block; margin-bottom: 5px; font-weight: bold;">Nom de l'utilisateur :</label>
            <input 
                type="text" 
                id="nom" 
                name="nom" 
                required 
                maxlength="255"
                value="<?= isset($old_values['nom']) ? htmlspecialchars($old_values['nom']) : '' ?>"
                style="width: 100%; padding: 8px; border: 1px solid #ccc; border-radius: 4px; box-sizing: border-box;"
            >
        </div> -->
        
        <!-- <div>
            <label for="email" style="display: block; margin-bottom: 5px; font-weight: bold;">Email :</label>
            <input 
                type="email" 
                id="email" 
                name="email" 
                required 
                value="<?= isset($old_values['email']) ? htmlspecialchars($old_values['email']) : '' ?>"
                style="width: 100%; padding: 8px; border: 1px solid #ccc; border-radius: 4px; box-sizing: border-box;"
            >
        </div>

        <div>
            <label for="password" style="display: block; margin-bottom: 5px; font-weight: bold;">Mot de passe :</label>
            <input 
                type="password" 
                id="password" 
                name="password" 
                required 
                style="width: 100%; padding: 8px; border: 1px solid #ccc; border-radius: 4px; box-sizing: border-box;"
            >
        </div>
        
        <button 
            type="submit" 
            style="padding: 10px 20px; background-color: #007bff; color: white; border: none; border-radius: 4px; cursor: pointer; font-size: 16px;"
        >
            Se connecter
        </button>
    </form>
    
    <div style="margin-top: 20px; display: flex; gap: 15px;">
        <a href="/products" style="color: #007bff; text-decoration: none;">📋 Voir la liste des produits</a>
        <span style="color: #ccc;">|</span>
        <a href="/" style="color: #007bff; text-decoration: none;">← Retour à l'accueil</a>
    </div> -->
</div> 
