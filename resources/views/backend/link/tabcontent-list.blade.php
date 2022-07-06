<div class="content table-responsive table-full-width">
                                <table class="table table-striped" id="your-link">
                                    <thead>
                                        <th>ID</th>
                                    	<th>Hash</th>
                                    	<th>Title</th>
                                    	<th>Original</th>
                                    	<th>Option</th>
                                    </thead>
                                    <tbody>
                                    	@foreach($allurl as $item)
                                        <tr>
                                       		<td>{{ $item->id }}</td>
                                       		<td><a href="{{ route('getRedirect', $item->hash) }}">{{ $item->hash }}</a></td>
                                       		<td>{{ $item->link_title }}</td>
                                       		<td>{{ $item->origin_link }}</td>
                                       		<td>
                                                <a href="{{ route('deleteLink', $item->id) }}" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this item?');"><i class="ti-close"></i></a>
                                            </td>
                                        </tr>
                                       @endforeach
                                    </tbody>
                                </table>
                            </div>