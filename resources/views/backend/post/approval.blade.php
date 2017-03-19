@extends('canvas::backend.layout')

@section('title')
    <title>{{ \Canvas\Models\Settings::blogTitle() }} | Posts</title>
@stop

@section('content')
    <section id="main">
        @include('canvas::backend.shared.partials.sidebar-navigation')
        <section id="content">
            <div class="container">
                <div class="card">
                    <div class="card-header">
                        <ol class="breadcrumb">
                            <li><a href="{!! route('canvas.admin') !!}">Home</a></li>
                            <li><a href="{!! route('canvas.admin.post.index') !!}">Posts</a></li>
                            <li class="active">Approval List</li>
                        </ol>
                        <ul class="actions">
                            <li class="dropdown">
                                <a href="" data-toggle="dropdown">
                                    <i class="zmdi zmdi-more-vert"></i>
                                </a>
                                <ul class="dropdown-menu dropdown-menu-right">
                                    <li>
                                        <a href="{!! route('canvas.admin.post.index') !!}"><i class="zmdi zmdi-refresh-alt pd-r-5"></i> Refresh Posts</a>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                        @include('canvas::backend.shared.partials.errors')
                        @include('canvas::backend.shared.partials.success')
                        <h2>Posts&nbsp;
                            <small>This page provides list posts need to review and approved.
                        </h2>
                    </div>

                    <div class="table-responsive">
                        <table id="posts-approval" class="table table-condensed table-vmiddle">
                            <thead>
                                <tr>
                                    <th data-column-id="id" data-type="numeric" data-order="desc">ID</th>
                                    <th data-column-id="title">Title</th>
                                    <th data-column-id="author">Author</th>
                                    <th data-column-id="date" data-type="date" data-formatter="humandate">Date</th>
                                    <th data-column-id="view_url" data-sortable="false" data-visible="false">View URL</th>
                                    <th data-column-id="approval">Status Approval</th>
                                    <th data-column-id="commands" data-formatter="commands" data-sortable="false">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data as $post)
                                    <tr>
                                        <td>{{ $post->id }}</td>
                                        <td>{{ $post->title }}</td>
                                        <td>{{ $post->getAuthor($post->user_id) }}</td>
                                        @if($post->updated_at != $post->created_at)
                                            <td>{{ $post->updated_at->format('Y/m/d') . "<br/>" }} Last updated</td>
                                        @else
                                            <td>{{ $post->created_at->format('Y/m/d') . "<br/>" }} Published</td>
                                        @endif
                                        <td>{!! route('canvas.blog.post.show', $post->slug) !!}</td>
                                        <td>{{ ($post->is_approved == \Canvas\Meta\Constants::POST_APPROVED) ? '<span class="label label-success">Approved</span>' : '<span class="label label-warning">Waiting Approval</span>' }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                        @foreach ($data as $post)
                            <form method="POST" id="post-approval-{{ $post->id }}" action="{!! route('canvas.admin.post.toggle-approval', $post->id) !!}" style="display:none">
                                <input type="hidden" name="_token" value="{!! csrf_token() !!}">
                                <input type="hidden" name="_method" value="PUT">
                                <input type="hidden" name="is_approved" value="{{ \Canvas\Meta\Constants::POST_APPROVED }}">
                                <input type="hidden" name="approved_by" value="{{ Auth::guard('canvas')->user()->id }}">
                                <input type="hidden" name="approved_at" value="TRUE">
                            </form>
                        @endforeach
                    </div>
                </div>
            </div>
        </section>
    </section>
@stop

@section('unique-js')
    @if(Session::get('_delete-post'))
        @include('canvas::backend.shared.notifications.notify', ['section' => '_delete-post'])
        {{ \Session::forget('_delete-post') }}
    @endif
    @if(Session::get('_update-post'))
        @include('canvas::backend.shared.notifications.notify', ['section' => '_update-post'])
        {{ \Session::forget('_update-post') }}
    @endif
    @include('canvas::backend.post.partials.datatable')
@stop