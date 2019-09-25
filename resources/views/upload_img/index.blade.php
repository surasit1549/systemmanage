<form action="upload_img" method="post" enctype="multipart/form-data">
    @csrf
    <input type="text" name="name_img"  id="">
    <input type="file" name="image" id="">
    <input type="submit">
</form>