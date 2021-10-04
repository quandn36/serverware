@if (empty($height))
var editor = CKEDITOR.replace( '{!! $textID !!}' );
@else
var editor = CKEDITOR.replace( '{!! $textID !!}', {
    height: {!! $height !!}
});
@endif
CKFinder.setupCKEditor( editor );
