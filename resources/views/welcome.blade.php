<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>ПРОДУКТЫ</title>
        <link rel="stylesheet" href="{{asset('css/reset.css')}}" >
        <link rel="stylesheet" href="{{asset('css/style.css')}}" >

    </head>
    <body>

    <div class="sidebar">
        <div class="sidebar__border__logo">
        <div class="sidebar__logo">
            <img src="{{asset('img/logo.svg')}}" alt="logo">
        </div>
        </div>
        <h6 class="sidebar__phrase">Enterprise
            Resource
            Planning</h6>
        <h6 class="sidebar__products__lbl">Продукты </h6>
    </div>

    <div class="navbar">
        <hr class="navbar__red__line">
        <h6 class="navbar__user__data">{{ Auth::user()->name }}</h6>
        <h6 class="navbar__products__red">ПРОДУКТЫ</h6>
    </div>


    <section class="app">

    <table>
        <thead>
        <tr>
            <th>АРТИКУЛ</th>
            <th>НАЗВАНИЕ</th>
            <th>СТАТУС</th>
            <th>АТРИБУТЫ</th>

        </tr>
        </thead>
        <tbody>

            @foreach($products as $product)
            <tr class="app__tbody__td">
                <td>{{ $product->article }} </td>
                <td>{{ $product->name }}</td>

                @if($product->status == 'available' )
                    <td>Доступен</td>
                @else
                    <td>Не доступен</td>
                @endif


                @foreach ( (array) $product->properties as $property)
                    <td><b>{{ $property['key'] }}</b>: {{ $property['value'] }}<br /></td>
                @endforeach


            </tr>
            @endforeach




        </tbody>

    </table>

        <button href="{{ route('products.create') }}" class="app__add__btn" id="myBtn">Добавить</button>

    </section>

    <div id="myModal" class="modal">
            <span class="close"><img src="{{asset('img/Close_round.svg')}}" alt="close"></span>

        <span class="modal__text">
            @isset($product)
                Изменить продукт  <b>{{ $product->name }}</b>
            @else
                Добавить продукт
            @endisset
                </span>

        <form class="modal__form" method="POST" enctype="multipart/form-data"
              @isset($product)
              action="{{ route('products.update', $product) }}"
              @else
              action="{{ route('products.store') }}"
              @endisset
              >
            @csrf
        <h6 class="modal__label">Артикул</h6>
        <input type="text" class="modal__input" name="article" value="@isset($product){{ $product->article }}@endisset">
        <h6 class="modal__label">Название</h6>
        <input type="text" class="modal__input" name="name" value="@isset($product){{ $product->article }}@endisset">
        <h6 class="modal__label">Статус</h6>

            <select class="modal__input" name="status">
                <option class="modal__select" value="available">Доступен</option>
                <option class="modal__select" value="unavailable">Не доступен</option>
            </select>
            <h6 class="modal__atrib">Атрибуты</h6>
            @for ($i=0; $i <= 1; $i++)
            <h6 class="modal__label">Название</h6>
            <input type="text" name="properties[{{ $i }}][key]" class="modal__input__atrib" value="{{ old('properties['.$i.'][key]') }}">

            <h6 class="modal__label">Значение</h6>
            <input type="text" name="properties[{{ $i }}][value]" class="modal__input__atrib" value="{{ old('properties['.$i.'][value]') }}">

            @endfor
            <input type="submit" class="modal__submit__btn" value="Добавить">

        </form>

    </div>


    <script src="{{ asset('/js/main.js') }}"></script>


    </body>
</html>
