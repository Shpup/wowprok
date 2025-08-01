<!DOCTYPE html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
    <title>Управление пользователями</title>
    <?php echo app('Illuminate\Foundation\Vite')(['resources/css/app.css', 'resources/js/app.js']); ?>
    <style>
        .user-table { width: 100%; border-collapse: collapse; }
        .user-table th, .user-table td { padding: 0.5rem; border: 1px solid #ddd; text-align: left; }
        .user-table th { background-color: #f3f4f6; }
        .permission-checkbox { margin: 0.25rem; }
    </style>
</head>
<body class="antialiased">
<div class="min-h-screen bg-gray-50">
    <?php echo $__env->make('layouts.navigation', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <div class="container mx-auto p-6">
        <h1 class="text-3xl font-bold text-gray-800 mb-8">Управление пользователями</h1>
        <table class="user-table">
            <thead>
            <tr>
                <th>ID</th>
                <th>Имя</th>
                <th>Email</th>
                <th>Роли</th>
                <th>Разрешения</th>
                <th>Действия</th>
            </tr>
            </thead>
            <tbody>
            <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                    <td><?php echo e($user->id); ?></td>
                    <td><?php echo e($user->name); ?></td>
                    <td><?php echo e($user->email); ?></td>
                    <td>
                        <?php $__currentLoopData = $user->roles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $role): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <span class="inline-block bg-gray-200 rounded-full px-2 py-1 text-sm mr-1"><?php echo e($role->name); ?></span>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </td>
                    <td>
                        <form id="permissionForm-<?php echo e($user->id); ?>" class="permission-form">
                            <?php echo csrf_field(); ?>
                            <?php $__currentLoopData = $permissions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $permission): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <label class="permission-checkbox">
                                    <input type="checkbox" name="permissions[]" value="<?php echo e($permission->name); ?>"
                                        <?php echo e($user->hasPermissionTo($permission->name) ? 'checked' : ''); ?>>
                                    <?php echo e($permission->name); ?>

                                </label>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </form>
                    </td>
                    <td>
                        <button onclick="savePermissions(<?php echo e($user->id); ?>)" class="bg-blue-600 text-white py-1 px-2 rounded-md hover:bg-blue-700">Сохранить</button>
                    </td>
                </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
        </table>
    </div>
</div>

<script>
    // Глобальная функция savePermissions
    function savePermissions(userId) {
        const form = document.getElementById(`permissionForm-${userId}`);
        if (!form) {
            console.error('Форма не найдена для userId:', userId);
            alert('Ошибка: Форма не найдена');
            return;
        }
        const formData = new FormData(form);
        const token = document.querySelector('meta[name="csrf-token"]').content;

        fetch(`/users/${userId}/permissions`, {
            method: 'POST',
            body: formData,
            headers: {
                'X-CSRF-TOKEN': token,
                'Accept': 'application/json'
            }
        })
            .then(response => {
                if (!response.ok) {
                    throw new Error('Ошибка при обновлении разрешений');
                }
                return response.json();
            })
            .then(data => {
                alert(data.success);
            })
            .catch(error => {
                console.error('Ошибка:', error);
                alert('Ошибка: ' + error.message);
            });
    }

    // Инициализация при загрузке страницы (опционально)
    document.addEventListener('DOMContentLoaded', function() {
        // Здесь можно добавить дополнительную логику, если потребуется
    });
</script>
</body>
</html>
<?php /**PATH C:\Users\polio\Desktop\main_prokat\main_prokat1\resources\views/users/index.blade.php ENDPATH**/ ?>