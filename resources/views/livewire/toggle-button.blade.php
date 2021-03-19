<div>
    <div class="custom-control custom-switch">
        <input type="checkbox" name="enable_sidebar" class="custom-control-input" id="switchNavbar" wire:click="$toggle('isActive')">
        <label class="custom-control-label" for="switchNavbar" wire:click="$emit('enableSidebar')">sidebar</label>
    </div>
</div>
