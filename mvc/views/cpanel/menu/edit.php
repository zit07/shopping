<div class="">
    <div class="page-title">
        <div class="title_left">
            <h3><?= $data['title'] ?></h3>
            <a href="<?= $data['template'].'/index' ?>" class="btn btn-primary"><i class="fa fa-backward"></i></a>
        </div>
    </div>
    <div class="clearfix"></div>
    <div class="">
        <form class="" action="" method="post" novalidate>
            <div class="row">
                <div class="col-6">
                    <div class="form-group">
                        <input type="hidden" name="" id="parentID" value="<?=  $data['datas']['cateID']  ?>"> 
                        <label for="">Danh mục cha</label>
                        <select name="data_post[parentID]" class="form-control" id="">
                                <option value="0">Chọn danh mục cha</option>
                            <?php if (isset($data['parent']) && $data['parent']!=null) {?>
                                <?php foreach ($data['parent'] as $key => $val) {?>
                                    <option value="<?= $val['id'] ?>" <?= $val['id'] == $data['datas']['parentID']?'selected':'' ?>><?= $val['name'] ?></option>
                                <?php } ?>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="form-group">
                       <div class="row">
                           <div class="col-4">
                                <label for="name">Loại bài viết</label>
                                <select name="data_post[type]" id="type" class="form-control">
                                    <option value="0" <?= $data['datas']['type'] == '2' ? 'selected' : '' ?>>Link</option>
                                    <option value="1" <?= $data['datas']['type'] == '1' ? 'selected' : '' ?>  >Sản phẩm</option>
                                </select>
                           </div>
                           <div class="col-8">
                               <label for="">Liên kết</label>
                               <div id="select">

                               </div>
                           </div>
                       </div>
                    </div>
                    <div class="form-group">
                        <label for="publish">Hiển thị</label>
                        <input id="publish" type="checkbox" value="1" <?= $data['datas']['publish'] == 1?'checked':'' ?> name="data_post[publish]">
                    </div>
                </div>
                <div class="col-6">
                    <div class="form-group">
                        <label for="">Tên menu</label>
                        <input type="text" class="form-control" value="<?= $data['datas']['name'] ?>" name="data_post[name]">
                    </div>
                </div>
                <div class="col-12">
                    <div class="form-group">
                        <button class="btn btn-primary" name="submit" type="submit">Cập nhật</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
<script>
    let type = document.querySelector('#type');
    let nameMenu = document.querySelector('input[name="data_post[name]"]');
    let cateID = document.querySelector('#parentID').value;
    let eventChange = new Event('change');
    type.addEventListener('change',(e)=>{
       let xhr = new XMLHttpRequest();
       xhr.open('POST','cpanel/menu/getCate');
       xhr.setRequestHeader('Content-Type','application/x-www-form-urlencoded');
       xhr.onload = function(event){
            document.getElementById('select').innerHTML = JSON.parse(this.responseText).data === '' ? '<input type="text" class="form-control" value="<?= $data['datas']['url'] ?>" name="data_post[url]">' : JSON.parse(this.responseText).data;
            let selectedName = document.querySelector('select[name="data_post[cateID]"]');
            if(JSON.parse(this.responseText).data !== ''){ 
                selectedName.addEventListener('change',(e)=>{
                    let name = e.target.options[e.target.selectedIndex].text;
                    const regex = /[-|+]/g;
                    nameMenu.value = name.replace(regex,'');
                });
                selectedName.dispatchEvent(eventChange)
            }
       }
       xhr.send('type='+e.target.value+'&cateID='+cateID+'');
    });
    type.dispatchEvent(eventChange)
</script>
