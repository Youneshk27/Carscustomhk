<form action="{{ route('calificaciones.store') }}" method="POST">
    @csrf
    <input type="hidden" name="taller_id" value="{{ $taller->id }}">
    <div class="form-group">
        <label for="rating">Calificación</label>
        <div class="rating">
            <input type="radio" name="rating" value="5" id="5"><label for="5">☆</label>
            <input type="radio" name="rating" value="4" id="4"><label for="4">☆</label>
            <input type="radio" name="rating" value="3" id="3"><label for="3">☆</label>
            <input type="radio" name="rating" value="2" id="2"><label for="2">☆</label>
            <input type="radio" name="rating" value="1" id="1"><label for="1">☆</label>
        </div>
    </div>
    <div class="form-group">
        <label for="comentario">Comentario</label>
        <textarea name="comentario" id="comentario" class="form-control"></textarea>
    </div>
    <button type="submit" class="btn btn-primary mt-3">Enviar</button>
</form>

<style>
    .rating {
        direction: rtl;
        unicode-bidi: bidi-override;
        text-align: center;
        margin-top: 10px;
    }
    .rating > input {
        display: none;
    }
    .rating > label {
        font-size: 2em;
        color: #ddd;
        cursor: pointer;
    }
    .rating > input:checked ~ label {
        color: #f70;
    }
    .rating > input:hover ~ label,
    .rating > label:hover ~ input ~ label {
        color: #fc0;
    }
</style>
