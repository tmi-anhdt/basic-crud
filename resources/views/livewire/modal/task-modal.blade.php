<div class="container px-4 py-5">
    <div class="modal show d-block" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content text-bg-gray">
                <div class="modal-header d-flex justify-content-between">
                    <h5 class="modal-title">
                        {{ $form->task ? 'Edit Task' : 'Create Task' }}
                    </h5>
                    <button type="button" class="btn btn-close shadow-none" wire:click="closeModal">
                    </button>
                </div>
                <div class="modal-body">
                    <form wire:submit="save">
                        <div class="form-group mb-3">
                            <label for="content">Content</label>
                            <input type="text" class="form-control" id="content" placeholder="Enter task content"
                                wire:model='form.content'>
                            <div class="text-danger">
                                @error('form.content')
                                    {{ $message }}
                                @enderror
                            </div>
                        </div>
                        @if (!!$form->task)
                            <div class="form-group d-flex flex-col gap-2">
                                <label for="status">Status</label>
                                <select id="status" name="status" wire:model='form.status'>
                                    <option value="Completed">Completed</option>
                                    <option value="In-progress">In-progress
                                    </option>
                                    <option value="Canceled">Canceled</option>
                                </select>
                            </div>
                            <div class="text-danger">
                                @error('form.status')
                                    {{ $message }}
                                @enderror
                            </div>
                        @endif
                        <button type="submit" class="btn btn-primary mt-4">
                            {{ $form->task ? 'Save' : 'Create' }}
                        </button>
                        <button type="button" wire:click="closeModal" class="btn btn-secondary mt-4">Close</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="modal-backdrop fade show"></div>
</div>
