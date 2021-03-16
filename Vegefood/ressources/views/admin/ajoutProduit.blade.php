@extends('layout.appadmin')

@section('content')
<div class="main-panel">
    <div class="content-wrapper">
        <div class="row grid-margin">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                    <h4 class="card-title">Ajouter un produit</h4>

                    <?php
                        $message = Session::get('message');
                        $message1 = Session::get('message1');
                    ?>
                    @if ($message)
                        <p class="alert alert-success">
                            <?php
                                echo $message;
                                Session::put('message', null);
                            ?>
                        </p>
                    @endif
                    @if ($message1)
                    <p class="alert alert-danger">
                        <?php
                            echo $message1;
                            Session::put('message1', null);
                        ?>
                    </p>
                    @endif

                    {{Form::open(['action' => 'ProduitController@enregistrerProduit' ,
                    'method' => 'POST', 'class' => 'form-horizontal', 'enctype' => 
                    'multipart/form-data'])}}

                    {{-- <form class="cmxform" id="commentForm" method="get" action="#"> --}}
                        <fieldset>
                            <div class="form-group">
                                <label for="cname">Nom</label>
                                <input id="cname" class="form-control" name="name" minlength="2" type="text" required>
                            </div>
                            <div class="form-group">
                                <label for="cname">Prix</label>
                                <input id="cname" class="form-control" name="price" minlength="1" type="text" required>
                            </div>
                            <div class="form-group">
                                <label for="cname">Catégorie</label>
                                    <?php
                                        $categories = DB::table('categories') 
                                                    ->get();
                                    ?>
                                    <select id="sortingField" class="form-control"
                                    name="category">
                                        <option>Selectionner catégorie</option>
                                        @foreach ($categories as $category)
                                            <option> {{$category->name}} </option>
                                        @endforeach
                                    </select>
                            </div>
                            <div class="form-group">
                                <label for="cname">Image</label>
                                {{Form::file('productImage', ['id' => 'cname', 'class' => 'form-control'])}}
                            </div>
                            <div class="form-group">
                                <label for="cname">Statut</label>
                                <input type="checkbox" name="status" value="1" required>
                            </div>
                            <input class="btn btn-primary" type="submit" value="Ajouter">
                        </fieldset>
                    {{-- </form> --}}
                    {{ Form::close() }}
                    </div>
                </div>
        </div>
    </div>
    
@endsection