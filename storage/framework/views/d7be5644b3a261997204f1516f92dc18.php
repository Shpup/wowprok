<!DOCTYPE html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Проект: <?php echo e($project->name); ?></title>
    <?php echo app('Illuminate\Foundation\Vite')(['resources/css/app.css', 'resources/js/app.js']); ?>
</head>
<body class="antialiased">
<div class="min-h-screen bg-gray-50">
    <?php echo $__env->make('layouts.navigation', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <div class="container mx-auto p-6">
        <h1 class="text-2xl font-semibold text-gray-800 mb-6">Проект: <?php echo e($project->name); ?></h1>

        <div class="bg-white rounded-lg shadow p-6 mb-6">
            <h2 class="text-xl font-semibold text-gray-700 mb-4">Детали проекта</h2>
            <p><strong>Описание:</strong> <?php echo e($project->description ?? 'Не указано'); ?></p>
            <p><strong>Менеджер:</strong> <?php echo e($project->manager->name ?? 'Не назначен'); ?></p>
            <p><strong>Даты:</strong> <?php echo e($project->start_date); ?> - <?php echo e($project->end_date ?? 'Не указано'); ?></p>
        </div>

        <div class="bg-white rounded-lg shadow p-6 mb-6">
            <h2 class="text-xl font-semibold text-gray-700 mb-4">Смета</h2>
            <table class="min-w-full">
                <thead class="bg-gray-100">
                <tr>
                    <th class="px-6 py-3 text-left text-sm font-medium text-gray-600">Оборудование</th>
                    <th class="px-6 py-3 text-left text-sm font-medium text-gray-600">Статус</th>
                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('view prices')): ?>
                        <th class="px-6 py-3 text-left text-sm font-medium text-gray-600">Цена</th>
                    <?php endif; ?>
                </tr>
                </thead>
                <tbody>
                <?php $__currentLoopData = $project->equipment; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr class="border-t">
                        <td class="px-6 py-4"><?php echo e($item->name); ?></td>
                        <td class="px-6 py-4"><?php echo e($item->pivot->status); ?></td>
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('view prices')): ?>
                            <td class="px-6 py-4"><?php echo e($item->price ? number_format($item->price, 2) : 'Не указана'); ?></td>
                        <?php endif; ?>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('view prices')): ?>
                    <tfoot>
                    <tr>
                        <td colspan="2" class="px-6 py-4 text-right font-semibold">Итого:</td>
                        <td class="px-6 py-4 font-semibold">
                            <?php echo e(number_format($project->equipment->sum('price'), 2)); ?>

                        </td>
                    </tr>
                    </tfoot>
                <?php endif; ?>
            </table>
        </div>

        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('edit projects')): ?>
            <div class="bg-white rounded-lg shadow p-6">
                <h2 class="text-xl font-semibold text-gray-700 mb-4">Добавить оборудование</h2>
                <form action="<?php echo e(route('projects.addEquipment', $project)); ?>" method="POST">
                    <?php echo csrf_field(); ?>
                    <div class="mb-4">
                        <label for="equipment_id" class="block text-sm font-medium text-gray-600">Оборудование</label>
                        <select name="equipment_id" id="equipment_id" class="mt-1 block w-full border-gray-300 rounded-md" required>
                            <?php $__currentLoopData = $availableEquipment; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($item->id); ?>"><?php echo e($item->name); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>
                    <div class="mb-4">
                        <label for="status" class="block text-sm font-medium text-gray-600">Статус</label>
                        <select name="status" id="status" class="mt-1 block w-full border-gray-300 rounded-md" required>
                            <option value="on_stock">На складе</option>
                            <option value="assigned">Назначено</option>
                            <option value="used">Использовано</option>
                        </select>
                    </div>
                    <button type="submit" class="bg-blue-600 text-white py-2 px-4 rounded-md hover:bg-blue-700">
                        Добавить
                    </button>
                </form>
            </div>
        <?php endif; ?>
    </div>
</div>
</body>
</html>
<?php /**PATH C:\Users\polio\Desktop\main_prokat\main_prokat1\resources\views/projects/show.blade.php ENDPATH**/ ?>