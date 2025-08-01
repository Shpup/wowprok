<div class="collapsible" data-category-id="<?php echo e($category->id); ?>">
    <div class="category-item">
        <div class="category-name">
            <a href="#" onclick="loadEquipment(<?php echo e($category->id); ?>)" class="text-blue-600 hover:underline" style="margin-left: <?php echo e($depth * 1); ?>rem;"><?php echo e($category->name); ?></a>
        </div>
        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('create projects')): ?>
            <button onclick="openCategoryModal(<?php echo e($category->id); ?>)" class="add-button">+</button>
        <?php endif; ?>
        <?php if($category->children->isNotEmpty()): ?>
            <button class="expand-toggle">▼</button>
        <?php endif; ?>
        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('delete projects')): ?>
            <?php if(auth()->id() === $category->user_id || auth()->user()->hasRole('admin')): ?>
                <button onclick="deleteCategory(<?php echo e($category->id); ?>)" class="text-red-600 hover:underline ml-2 delete-button">Удалить</button>
            <?php endif; ?>
        <?php endif; ?>
    </div>
    <div class="collapsible-content">
        <?php $__currentLoopData = $category->children; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $child): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php echo $__env->make('equipment.category-item', ['category' => $child, 'depth' => $depth + 1], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
</div>
<?php /**PATH C:\Users\polio\Desktop\main_prokat\main_prokat1\resources\views/equipment/category-item.blade.php ENDPATH**/ ?>