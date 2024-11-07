<div class="list-group">
    <a href="{{ route('link', ['link' => $link]) }}" class="list-group-item list-group-item-action">Home</a>
    <a href="{{ route('link.lucky.create', ['link' => $link]) }}" class="list-group-item list-group-item-action">Imfeelinglucky</a>
    <a href="{{ route('link.history', ['link' => $link]) }}" class="list-group-item list-group-item-action">History</a>
    <a href="{{ route('link.create', ['link' => $link]) }}" class="list-group-item list-group-item-action">Create New Link</a>
    <a href="{{ route('link.disable', ['link' => $link]) }}" class="list-group-item list-group-item-action list-group-item-danger">Disable Link</a>
</div>
