<div class="jumbotron">
        <?php

        if(isset($posts)){
        ?>
        <h1><?=$posts['title']?></h1>
        <p class="lead"><?=$posts['text']?></p>
        <p><?=$posts['date_added']?></p>
      </div>


        <div>
            <div id="uploads"></div>
            <div class="dropzone" id="dropzone">Drop files here to upload</div>
            <script>
                (function(){
                    var dropzone = document.getElementById('dropzone');

                    var displayUploads = function(data){
                        var uploads = document.getElementById('uploads'),
                            anchor,
                            x;

                        for(x = 0; x < data.length; x++){
                            if(data[x].status === true){
                                anchor = document.createElement('img');
                                anchor.width = 200;
                                anchor.height = 200;
                                anchor.src = "http://localhost:8088/mvc_cms/" + data[x].file;
                                //anchor.innerText = data[x].name;

                                uploads.appendChild(anchor);
                            }
                        }
                    }

                    var upload = function(files){
                        var formData = new FormData(),
                            xhr = new XMLHttpRequest(),
                            x;

                        for(x = 0; x < files.length; x++){
                            formData.append('file[]', files[x]);
                        }

                        xhr.onload = function(){
                            var data = JSON.parse(this.responseText);
                            //console.log(data);
                            displayUploads(data);
                        }

                        xhr.open('post', 'http://localhost:8088/mvc_cms/upload');
                        xhr.send(formData);

                    }

                    dropzone.ondrop = function(e){
                        e.preventDefault();
                        this.className = 'dropzone';
                        //console.log(e.dataTransfer.files);
                        upload(e.dataTransfer.files);
                    };

                    dropzone.ondragover = function(){
                        this.className = 'dropzone dragover';
                        return false;
                    };

                    dropzone.ondragleave = function(){
                        this.className = 'dropzone';
                        return false;
                    };
                }());
            </script>
            <?php
                if(\Shareed2k\Session::exists('error')){

                    foreach(unserialize(\Shareed2k\Session::flash('error')) as $error){
                        echo "<p>",$error,"</p>";
                    }
                }
            ?>
            <form action="http://localhost:8088/mvc_cms/post/addcomment" method="post">
                <p><input name="author"></p>
                <input type="hidden" name="post_id" value="<?= $posts['id']?>">
                <input type="hidden" name="token" value="<?= \Shareed2k\Token::generate(); ?>">
                <p><textarea name="com_text"></textarea></p>
                <p><input type="submit"></p>
            </form>
        </div>
      </div>
        <?php
}else{
    echo "<p>no posts here</p>";
}
?>