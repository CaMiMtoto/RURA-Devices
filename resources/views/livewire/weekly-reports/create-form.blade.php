<div>
    <p>
        Fill out the form below to create a new weekly report.
    </p>
    <div>
        @if(session()->has('message'))
            <div class="alert alert-success">{{ session('message') }}</div>
        @endif


        <!-- Step Indicators -->
        <ul class="nav   nav-tabs nav-line-tabs nav-line-tabs-2x mb-5 fs-6">
            <li class="nav-item">
                <a class="nav-link @if($step === 1) active @endif" href="#" wire:click.prevent="$set('step', 1)">
                    Report Info
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link @if($step === 2) active @endif" href="#" wire:click.prevent="$set('step', 2)"
                   @if(!$reportId) style="pointer-events:none;opacity:0.5;" @endif>Tasks</a>
            </li>
        </ul>

        <!-- Step 1: Report Info -->
        @if($step === 1)
            <div>
                <div class="mb-3">
                    <label for="report_title" class="form-label">Report Title</label>
                    <input type="text" id="report_title"
                           class="form-control @error('report_title') is-invalid @enderror"
                           wire:model.defer="report_title">
                    @error('report_title')
                    <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <div class="row mb-3">
                    <div class="col">
                        <label class="form-label">Start Week Date</label>
                        <input type="date" class="form-control @error('week_start_date') is-invalid @enderror"
                               wire:model.defer="week_start_date">
                        @error('week_start_date')
                        <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                    <div class="col">
                        <label class="form-label">End Week Date</label>
                        <input type="date" class="form-control @error('week_end_date') is-invalid @enderror"
                               wire:model.defer="week_end_date">
                        @error('week_end_date')
                        <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label">Notes (optional)</label>
                    <textarea rows="3" class="form-control" id="editor" wire:model.defer="notes"></textarea>
                </div>
            </div>
        @endif

        <!-- Step 2: Tasks -->
        @if($step === 2)
            <div>
                <div>
                    <h4>Tasks</h4>
                    <p>
                        Below are the tasks for this week and next week. You can add new tasks by clicking the "Add New"
                        button.
                    </p>
                    <hr>
                    <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center mb-3">
                        <div>
                            <h5>This Week's Tasks</h5>
                            <p>
                                These are the tasks you need to complete this week.
                            </p>
                        </div>
                        <div>
                            <button class="btn btn-primary mb-3 btn-sm" data-bs-toggle="modal"
                                    data-bs-target="#taskModal"
                                    wire:click="prepareNewTask('this_week')">
                                Add New
                            </button>
                        </div>
                    </div>

                    @if($this_week_tasks->isEmpty())
                        <div class="alert alert-info">
                            No tasks have been added yet.
                        </div>
                    @else
                        <ul class="list-group mb-3 list-group-numbered">
                            @forelse($this_week_tasks as $i => $task)
                                <li class="list-group-item d-flex  bg-transparent">
                                    <div class="flex-grow-1 d-flex justify-content-between align-items-center">
                                        <div>
                                            <strong>{{ $task['task'] }}</strong> — {{ $task['objective'] }} <br>
                                            Priority:
                                            <span
                                                class="badge bg-{{$task['priority_color']}}-subtle text-{{$task['priority_color']}}">
                                        {{ ucfirst($task['priority']) }}
                                    </span>
                                            | Deadline: {{ $task['deadline'] ?? 'N/A' }}
                                        </div>
                                        <button class="btn  text-hover-danger rounded btn-sm btn-icon"
                                                title="Delete Task"
                                                wire:click="removeTask({{ $task->id }})">
                                            <x-lucide-trash class="tw-w-5 tw-h-5"/>
                                        </button>
                                    </div>

                                </li>
                            @empty
                            @endforelse
                        </ul>
                    @endif

                </div>

                <div class="d-flex justify-content-between align-items-center mb-3">
                    <div>
                        <h6>Next Week's Tasks</h6>
                        <p>
                            These are the tasks you need to complete next week.
                        </p>
                    </div>
                    <button class="btn btn-secondary mb-3 ms-2 btn-sm" data-bs-toggle="modal"
                            data-bs-target="#taskModal"
                            wire:click="prepareNewTask('next_week')">
                        Add New
                    </button>
                </div>

                <ul class="list-group mb-3 list-group-numbered">
                    @foreach($next_week_tasks as $i => $task)
                        <li class="list-group-item d-flex  bg-transparent">
                            <div class="flex-grow-1 d-flex justify-content-between align-items-center">
                                <div>
                                    <strong>{{ $task['task'] }}</strong> — {{ $task['objective'] }} <br>
                                    Status:
                                    <span
                                        class="badge bg-{{$task['status_color']}}-subtle text-{{$task['status_color']}}">
                                        {{ \Illuminate\Support\Str::of(ucfirst(ucwords($task['status'],'_')))->replace('_',' ') }}
                                    </span>
                                </div>
                                <button class="btn btn-light-danger rounded-pill btn-sm btn-icon"
                                        wire:click="removeThisWeekTask({{ $i }})">
                                    <x-lucide-x class="tw-w-5 tw-h-5"/>
                                </button>
                            </div>

                        </li>
                    @endforeach
                </ul>

            </div>
        @endif

        <!-- Navigation Buttons -->
        <div class="d-flex justify-content-between mt-4">
            @if($step > 1)
                <button class="btn btn-secondary" wire:click="goToPreviousStep" wire:loading.attr="disabled">
                    Previous
                    <x-lucide-loader class="tw-w-5 tw-h-5 tw-ml-2 tw-animate-spin" wire:loading/>
                </button>
            @endif

            @if($step === 1)
                <button class="btn btn-primary" wire:click="goToNextStep" wire:loading.attr="disabled">
                    Next
                    <x-lucide-loader class="tw-w-5 tw-h-5 tw-ml-2 tw-animate-spin" wire:loading/>
                </button>
            @elseif($step === 2)
                <button class="btn btn-success" wire:click="submitReport" wire:loading>
                    Submit Report
                    <x-lucide-loader class="tw-w-5 tw-h-5 tw-ml-2 tw-animate-spin" wire:loading/>
                </button>
            @endif
        </div>

    </div>

    <!-- Task Modal (same as before) -->
    <div class="modal fade" id="taskModal" tabindex="-1" aria-labelledby="taskModalLabel" aria-hidden="true"
         wire:ignore.self>
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <form wire:submit.prevent="addTask" novalidate>
                    <div class="modal-header">
                        <h5 class="modal-title" id="taskModalLabel">Add Task</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label>Task</label>
                            <input type="text" class="form-control @error('taskForm.task') is-invalid @enderror"
                                   wire:model.defer="taskForm.task" required>
                            @error('taskForm.task')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label>Objective</label>
                            <textarea class="form-control @error('taskForm.objective') is-invalid @enderror"
                                      wire:model.defer="taskForm.objective"></textarea>
                            @error('taskForm.objective')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label>Priority</label>
                            <select class="form-select @error('taskForm.priority') is-invalid @enderror"
                                    wire:model.defer="taskForm.priority" required>
                                <option value="">Select</option>
                                <option value="low">Low</option>
                                <option value="medium">Medium</option>
                                <option value="high">High</option>
                            </select>
                            @error('taskForm.priority')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label>Deadline</label>
                            <input type="date" class="form-control @error('taskForm.deadline') is-invalid @enderror"
                                   wire:model.defer="taskForm.deadline"/>
                            @error('taskForm.deadline')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Add Task</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @push('scripts')
        {{-- <script type="importmap">
             {
                 "imports": {
                     "ckeditor5": "{{ asset('assets/plugins/ckeditor5/ckeditor5.js') }}",
                     "ckeditor5/": "/assets/vendor/"
                 }
             }
         </script>
         <script type="module">
             import {
                 ClassicEditor,
                 Essentials,
                 Paragraph,
                 Bold,
                 Italic,
                 Font,
                 Autoformat,
                 Underline,
                 BlockQuote,
                 Base64UploadAdapter,
                 CloudServices,
                 CKBox,
                 Heading,
                 Image,
                 ImageCaption,
                 ImageResize,
                 ImageStyle,
                 ImageToolbar,
                 ImageUpload,
                 PictureEditing,
                 Indent,
                 IndentBlock,
                 Link,
                 List,
                 MediaEmbed,
                 Mention,
                 PasteFromOffice,
                 Table,
                 TableColumnResize,
                 TableToolbar,
                 TextTransformation
             } from 'ckeditor5';

             ClassicEditor
                 .create(document.querySelector('#editor'), {
                     licenseKey: 'GPL', // Or 'GPL'.
                     plugins: [Essentials, Paragraph, Bold, Italic, Font,Autoformat,
                         BlockQuote,
                         Bold,
                         CloudServices,
                         Essentials,
                         Heading,
                         Image,
                         ImageCaption,
                         ImageResize,
                         ImageStyle,
                         ImageToolbar,
                         ImageUpload,
                         Base64UploadAdapter,
                         Indent,
                         IndentBlock,
                         Italic,
                         Link,
                         List,
                         MediaEmbed,
                         Mention,
                         Paragraph,
                         PasteFromOffice,
                         PictureEditing,
                         Table,
                         TableColumnResize,
                         TableToolbar,
                         TextTransformation,
                         Underline],
                     toolbar: [
                         'undo', 'redo', '|', 'bold', 'italic', '|','underline',
                         '|',
                         'link',
                         'uploadImage',
                         'insertTable',
                         'blockQuote',
                         'mediaEmbed',
                         '|',
                         'bulletedList',
                         'numberedList',
                         '|',
                         'outdent',
                         'indent',
                         'fontSize', 'fontFamily', 'fontColor', 'fontBackgroundColor'
                     ],
                     heading: {
                         options: [
                             {
                                 model: 'paragraph',
                                 title: 'Paragraph',
                                 class: 'ck-heading_paragraph'
                             },
                             {
                                 model: 'heading1',
                                 view: 'h1',
                                 title: 'Heading 1',
                                 class: 'ck-heading_heading1'
                             },
                             {
                                 model: 'heading2',
                                 view: 'h2',
                                 title: 'Heading 2',
                                 class: 'ck-heading_heading2'
                             },
                             {
                                 model: 'heading3',
                                 view: 'h3',
                                 title: 'Heading 3',
                                 class: 'ck-heading_heading3'
                             },
                             {
                                 model: 'heading4',
                                 view: 'h4',
                                 title: 'Heading 4',
                                 class: 'ck-heading_heading4'
                             }
                         ]
                     },
                     image: {
                         resizeOptions: [
                             {
                                 name: 'resizeImage:original',
                                 label: 'Default image width',
                                 value: null
                             },
                             {
                                 name: 'resizeImage:50',
                                 label: '50% page width',
                                 value: '50'
                             },
                             {
                                 name: 'resizeImage:75',
                                 label: '75% page width',
                                 value: '75'
                             }
                         ],
                         toolbar: [
                             'imageTextAlternative',
                             'toggleImageCaption',
                             '|',
                             'imageStyle:inline',
                             'imageStyle:wrapText',
                             'imageStyle:breakText',
                             '|',
                             'resizeImage'
                         ]
                     },
                     link: {
                         addTargetToExternalLinks: true,
                         defaultProtocol: 'https://'
                     },
                     table: {
                         contentToolbar: [ 'tableColumn', 'tableRow', 'mergeTableCells' ]
                     },
                 })
                 .then(editor => {
                     window.editor = editor;
                 })
                 .catch(error => {
                     console.error(error);
                 });
         </script>--}}
        @script
        <script>
            $wire.on('hide-modal', (event) => {
                const props = event[0];
                console.log(props);
                console.log(props.id)
                const modal = bootstrap.Modal.getInstance(document.getElementById(props.id));
                if (modal)
                    modal.hide();
            });
        </script>
        @endscript
        <script>

            /*  window.addEventListener('hide-modal', event => {
                  const modal = bootstrap.Modal.getInstance(document.getElementById(event.detail.id));
                  modal.hide();
              });*/
        </script>
    @endpush
</div>
