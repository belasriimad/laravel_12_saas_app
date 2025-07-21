@extends('layouts.app')


@section('title')
    Qrcodes
@endsection

@section('content')
    <div class="row mt-5">
        <div class="col-md-12">
            <div class="mb-3">
                <a class="text-dark text-decoration-none" href="{{ route('qrcodes.create') }}">
                    <i class="fas fa-plus"></i> Create a Qrcode
                </a>
            </div>
            <div
                class="table-responsive"
            >
                <table
                    class="table table-bordered border-dark"
                >
                    <thead>
                        <tr>
                            <th scope="col">Content</th>
                            <th scope="col">Qrcode</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if($qrcodes->count())
                            @foreach ($qrcodes as $qrcode)
                                <tr>
                                    <td>
                                        {{ $qrcode->content }}
                                    </td>
                                    <td>
                                        <img src="{{asset($qrcode->qr_code_path)}}" 
                                            alt="Qrcode Generated" 
                                            class="img-fluid mb-1"
                                            width="60"
                                            height="60"    
                                        >
                                    </td>
                                    <td>
                                        <a href="{{asset($qrcode->qr_code_path)}}" download class="btn btn-sm btn-dark">
                                            <i class="fas fa-download"></i>
                                        </a>
                                        <a href="{{route('qrcodes.edit',$qrcode->id)}}" class="btn btn-sm btn-warning">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <a href="#" 
                                            onclick="deleteItem({{$qrcode->id}})"
                                            class="btn btn-sm btn-danger">
                                            <i class="fas fa-trash"></i>
                                        </a>
                                        <form id="{{$qrcode->id}}" action="{{route('qrcodes.destroy',$qrcode->id)}}" method="post">
                                            @csrf
                                            @method("DELETE")
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        @else 
                            <tr>
                                <td colspan="3">
                                    <div class="my-3">
                                        <div class="alert alert-info">
                                            No Qrcodes!
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @endif  
                    </tbody>
                </table>
                <div class="my-3 justify-content-center">
                    {{ $qrcodes->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection