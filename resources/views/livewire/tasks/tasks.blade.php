<div>
    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            {{ $message }}
        </div>
    @endif

    <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="col col-md-6"><b>Tasks</b></div>
                <div class="col col-md-6">
                    <button type="button" class="btn btn-success btn-sm float-end"
                        wire:click="$dispatch('openModal', { component: 'modal.task-modal' })">Create</button>
                </div>
            </div>
        </div>
        <div class="card-body">
            <table class="table table-bordered">
                <tr>
                    <th>ID</th>
                    <th>Content</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
                @forelse ($records as $record)
                    <tr wire:key='{{ $record->id }}'>
                        <td>{{ $record->id }}</td>
                        <td>
                            @if ($record->status === 'In-progress')
                                {{ $record->content }}
                            @else
                                <span
                                    style="color: {{ $record->status === 'Completed' ? 'green' : 'red' }};"><s>{{ $record->content }}</s></span>
                            @endif
                        </td>
                        <td>{{ $record->status }}</td>
                        <td>
                            <div>
                                <button type="button" class="btn btn-warning btn-sm"
                                    wire:click="$dispatch('openModal', { component: 'modal.task-modal', arguments: { task: {{ $record }} }})">Edit</button>
                                <button type="button" class="btn btn-sm btn-danger"
                                    wire:click="delete({{ $record }})"
                                    wire:confirm="Are you sure you want to delete this task?">Delete</button>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center">No Task Found</td>
                    </tr>
                @endforelse
            </table>

            {!! $records->links() !!}
        </div>
    </div>

    {{-- @if ($openModal)
        @include('livewire.modal.task-modal')
    @endif --}}

    {{-- <div x-data="{ open: false }">
        <button @click="open = ! open" class="flex p-4 text-lg font-bold text-red-600">
            Toggle Modal</button>

        @teleport('body')
            <div x-show="open">
                Modal contents...
            </div>
        @endteleport
    </div> --}}
</div>
