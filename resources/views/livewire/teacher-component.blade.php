<div>
    <x-confirmation-modal wire:model.live="confirmingDelete">
        <x-slot name="title">
            Eliminar Docente
        </x-slot>

        <x-slot name="content">
            ¿Estás seguro de que deseas eliminar este docente? Esta acción no se puede deshacer.
        </x-slot>

        <x-slot name="footer">
            <x-secondary-button wire:click="$set('confirmingDelete', false)">
                Cancelar
            </x-secondary-button>

            <x-danger-button wire:click="deleteTeacher">
                Sí, eliminar
            </x-danger-button>
        </x-slot>
    </x-confirmation-modal>
</div>
