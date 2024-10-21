<x-app-layout>
    <div class="container max-w-5xl mx-auto">
        <div class="mb-8 mt-3 flex justify-end px-4">
            <a href="{{ route('posts.create') }}"
                class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">
                Add Post
            </a>
        </div>
        <div class="">
            <table id="posts-table" class="table table-striped table-bordered">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50  ">
                    <tr>
                        <th scope="col" class="px-6 py-3">
                            Id
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Title
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Slug
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Content
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Action
                        </th>
                    </tr>
                </thead>

            </table>
        </div>

        <!-- Modal Delete Confirmation -->
        <div id="deleteModal" class="fixed inset-0 flex items-center justify-center hidden bg-black bg-opacity-50">
            <div class="bg-white rounded-lg shadow p-6">
                <h2 class="text-xl font-semibold mb-4">Are you sure?</h2>
                <p class="text-gray-600 mb-6">Do you really want to delete this post? This action cannot be undone.</p>
                <div class="flex justify-end gap-4">
                    <button id="cancelDelete" class="px-4 py-2 bg-gray-300 text-gray-700 rounded">Cancel</button>
                    <button id="confirmDelete" class="px-4 py-2 bg-red-600 text-white rounded">Delete</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            var table = $('#posts-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: '{{ route('posts.datatables') }}',
                    type: 'GET',
                },
                columns: [{
                        data: 'id',
                        name: 'id'
                    },
                    {
                        data: 'title',
                        name: 'title'
                    },
                    {
                        data: 'slug',
                        name: 'slug'
                    },
                    {
                        data: 'content',
                        name: 'content'
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false
                    },
                ]
            });

            // Event listener untuk tombol delete
            $('#posts-table').on('click', '.delete-btn', function() {
                var postId = $(this).data('id');
                $('#deleteModal').data('id', postId).removeClass('hidden');
            });

            // Event untuk cancel button di modal
            $('#cancelDelete').on('click', function() {
                $('#deleteModal').addClass('hidden');
            });

            // Event untuk confirm delete
            $('#confirmDelete').on('click', function() {
                var postId = $('#deleteModal').data('id');

                $.ajax({
                    url: '/posts/' + postId, // URL endpoint untuk delete
                    type: 'DELETE',
                    data: {
                        _token: '{{ csrf_token() }}' // Pastikan CSRF token dikirim
                    },
                    success: function(response) {
                        $('#deleteModal').addClass('hidden');
                        table.ajax.reload(null,
                        false); // Reload DataTable tanpa reset pagination
                    },
                    error: function(xhr) {
                        console.error('Error deleting post:', xhr);
                    }
                });
            });
        });
    </script>

    <div class="mt-16">
        <div class="container max-w-5xl mx-auto">
            <div class="mb-8 mt-3 flex justify-end px-4">
                <a href="{{ route('posts.create') }}"
                    class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">
                    Add Post
                </a>
            </div>
            <div class="mb-6">
                <h2 class="text-xl font-semibold mb-4">Posts with Odd IDs</h2>
                <table id="odd-posts-table" class="table table-striped table-bordered">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                        <tr>
                            <th>Id</th>
                            <th>Title</th>
                            <th>Slug</th>
                            <th>Content</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                </table>
            </div>
            <div class="mb-6">
                <h2 class="text-xl font-semibold mb-4">Posts with Even IDs</h2>
                <table id="even-posts-table" class="table table-striped table-bordered">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                        <tr>
                            <th>Id</th>
                            <th>Title</th>
                            <th>Slug</th>
                            <th>Content</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                </table>
            </div>

            <!-- Modal Delete Confirmation (same as before) -->
            <div id="deleteModal" class="fixed inset-0 flex items-center justify-center hidden bg-black bg-opacity-50">
                <div class="bg-white rounded-lg shadow p-6">
                    <h2 class="text-xl font-semibold mb-4">Are you sure?</h2>
                    <p class="text-gray-600 mb-6">Do you really want to delete this post? This action cannot be undone.</p>
                    <div class="flex justify-end gap-4">
                        <button id="cancelDelete" class="px-4 py-2 bg-gray-300 text-gray-700 rounded">Cancel</button>
                        <button id="confirmDelete" class="px-4 py-2 bg-red-600 text-white rounded">Delete</button>
                    </div>
                </div>
            </div>
        </div>

        <script>
            $(document).ready(function() {
                var oddTable = $('#odd-posts-table').DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: {
                        url: '{{ route('posts.odd') }}',
                        type: 'GET',
                    },
                    columns: [
                        { data: 'id', name: 'id' },
                        { data: 'title', name: 'title' },
                        { data: 'slug', name: 'slug' },
                        { data: 'content', name: 'content' },
                        { data: 'action', name: 'action', orderable: false, searchable: false },
                    ]
                });

                var evenTable = $('#even-posts-table').DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: {
                        url: '{{ route('posts.even') }}',
                        type: 'GET',
                    },
                    columns: [
                        { data: 'id', name: 'id' },
                        { data: 'title', name: 'title' },
                        { data: 'slug', name: 'slug' },
                        { data: 'content', name: 'content' },
                        { data: 'action', name: 'action', orderable: false, searchable: false },
                    ]
                });

                // Event listener for delete button (same as before)
                $('#odd-posts-table, #even-posts-table').on('click', '.delete-btn', function() {
                    var postId = $(this).data('id');
                    $('#deleteModal').data('id', postId).removeClass('hidden');
                });

                $('#cancelDelete').on('click', function() {
                    $('#deleteModal').addClass('hidden');
                });

                $('#confirmDelete').on('click', function() {
                    var postId = $('#deleteModal').data('id');

                    $.ajax({
                        url: '/posts/' + postId,
                        type: 'DELETE',
                        data: { _token: '{{ csrf_token() }}' },
                        success: function(response) {
                            $('#deleteModal').addClass('hidden');
                            oddTable.ajax.reload(null, false);
                            evenTable.ajax.reload(null, false);
                        },
                        error: function(xhr) {
                            console.error('Error deleting post:', xhr);
                        }
                    });
                });
            });
        </script>
    </div>
</x-app-layout>

