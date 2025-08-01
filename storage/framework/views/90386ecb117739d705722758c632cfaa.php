<!DOCTYPE html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Редактировать оборудование</title>
    <?php echo app('Illuminate\Foundation\Vite')(['resources/css/app.css', 'resources/js/app.js']); ?>
</head>
<body class="antialiased">
<div class="min-h-screen bg-gray-50">
    <?php echo $__env->make('layouts.navigation', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <div class="container mx-auto p-6">
        <h1 class="text-2xl font-semibold text-gray-800 mb-6">Редактировать оборудование</h1>
        <form action="<?php echo e(route('equipment.update', $equipment)); ?>" method="POST" enctype="multipart/form-data" class="bg-white p-6 rounded-lg shadow-md max-w-lg">
            <?php echo csrf_field(); ?>
            <?php echo method_field('PUT'); ?>
            <div class="mb-4">
                <label for="name" class="block text-sm font-medium text-gray-600">Название</label>
                <input type="text" name="name" id="name" value="<?php echo e($equipment->name); ?>" class="mt-1 block w-full border-gray-300 rounded-md" required>
            </div>
            <div class="mb-4">
                <label for="category_id" class="block text-sm font-medium text-gray-600">Категория</label>
                <select name="category_id" id="category_id" class="mt-1 block w-full border-gray-300 rounded-md">
                    <option value="">Нет</option>
                    <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($category->id); ?>" <?php echo e($equipment->category_id == $category->id ? 'selected' : ''); ?>><?php echo e($category->name); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
            </div>
            <div class="mb-4">
                <label for="description" class="block text-sm font-medium text-gray-600">Описание</label>
                <textarea name="description" id="description" class="mt-1 block w-full border-gray-300 rounded-md"><?php echo e($equipment->description); ?></textarea>
            </div>
            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('view prices')): ?>
                <div class="mb-4">
                    <label for="price" class="block text-sm font-medium text-gray-600">Цена</label>
                    <input type="number" step="0.01" name="price" id="price" value="<?php echo e($equipment->price); ?>" class="mt-1 block w-full border-gray-300 rounded-md">
                </div>
            <?php endif; ?>
            <div class="mb-4">
                <label for="specifications" class="block text-sm font-medium text-gray-600">Характеристики (JSON)</label>
                <textarea name="specifications" id="specifications" class="mt-1 block w-full border-gray-300 rounded-md"><?php echo e(json_encode($equipment->specifications)); ?></textarea>
            </div>
            <div class="mb-4">
                <label for="image" class="block text-sm font-medium text-gray-600">Изображение</label>
                <?php if($equipment->image): ?>
                    <img src="<?php echo e(Storage::url($equipment->image)); ?>" alt="<?php echo e($equipment->name); ?>" class="w-32 h-32 object-cover mb-2">
                <?php endif; ?>
                <input type="file" name="image" id="image" class="mt-1 block w-full border-gray-300 rounded-md">
            </div>
            <button type="submit" class="bg-blue-600 text-white py-2 px-4 rounded-md hover:bg-blue-700">Обновить</button>
        </form>
    </div>
</div>
</body>
</html>
<?php /**PATH C:\Users\polio\Desktop\main_prokat\main_prokat1\resources\views/equipment/edit.blade.php ENDPATH**/ ?>