<div id="product-form-container" style="display: none;">
    <style>
        .modal-overlay { position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0,0,0,0.7); z-index: 1000; display: flex; justify-content: center; align-items: center; }
        .modal-content { background: #fff; padding: 25px; border-radius: 12px; width: 95%; max-width: 1100px; max-height: 95vh; overflow-y: auto; }
        .modal-body-layout { display: grid; grid-template-columns: 1fr 1.2fr; gap: 30px; }
        .upload-zone { position: relative; border: 2px dashed #ccc; border-radius: 8px; height: 150px; display: flex; align-items: center; justify-content: center; background: #f9f9f9; cursor: pointer; transition: 0.3s; overflow: hidden; }
        .upload-zone:hover { border-color: #ff4500; background: #fff5f2; }
        .upload-zone img { width: 100%; height: 100%; object-fit: cover; position: absolute; top:0; left:0; }
        .upload-zone .plus-icon { font-size: 24px; color: #aaa; text-align: center; pointer-events: none; }
        .upload-zone .plus-icon span { display: block; font-size: 11px; margin-top: 5px; color: #999; }
        .remove-btn { position: absolute; top: 5px; right: 5px; background: rgba(255,0,0,0.8); color: white; border: none; border-radius: 50%; width: 22px; height: 22px; cursor: pointer; display: none; z-index: 20; font-weight: bold; line-height: 1; }
        .upload-zone.has-file .remove-btn { display: block; }
        .upload-zone.has-file .plus-icon { display: none; }
        .image-grid { display: grid; grid-template-columns: repeat(2, 1fr); gap: 15px; }
        .main-img-label { position: absolute; bottom: 0; left: 0; width: 100%; background: #ff4500; color: white; font-size: 10px; text-align: center; padding: 2px 0; font-weight: bold; z-index: 15; }
        .model-zone { height: 315px; width: 100%; }
        model-viewer { width: 100%; height: 100%; background-color: #eee; position: absolute; top:0; left:0; }
    </style>

    <div class="modal-overlay">
        <div class="modal-content">
            <h1 class="dash__h1 u-s-m-b-20 u-c-secondary" id="form-title">THÊM SẢN PHẨM</h1>
            <form id="product-form" enctype="multipart/form-data">
                <input type="hidden" name="_method" id="form-method" value="POST">
                <div class="modal-body-layout">
                    <div class="info-section">
                        <div class="u-s-m-b-15">
                            <label class="gl-label">TÊN SẢN PHẨM *</label>
                            <input class="input-text input-text--primary-style" type="text" id="product-name" name="name" required>
                        </div>
                        <div style="display:flex; gap:15px">
                            <div class="u-s-m-b-15" style="flex:1">
                                <label class="gl-label">GIÁ (VND) *</label>
                                <input class="input-text input-text--primary-style" type="number" id="product-price" name="price" required>
                            </div>
                            <div class="u-s-m-b-15" style="flex:1">
                                <label class="gl-label">KHO HÀNG *</label>
                                <input class="input-text input-text--primary-style" type="number" id="product-stock" name="quantity" required>
                            </div>
                        </div>
                        <div class="u-s-m-b-15">
                            <label class="gl-label">DANH MỤC *</label>
                            <select class="select-box select-box--primary-style" id="product-category" name="category_id" required>
                                <option value="">Chọn danh mục</option>
                            </select>
                        </div>
                        <div class="u-s-m-b-15">
                            <label class="gl-label">MÔ TẢ *</label>
                            <textarea class="text-area text-area--primary-style" id="product-description" name="description" required style="height: 120px;"></textarea>
                        </div>
                    </div>

                    <div class="upload-section">
                        <label class="gl-label u-s-m-b-10">HÌNH ẢNH (Ô 1 LÀ ẢNH CHÍNH) *</label>
                        <div class="image-grid">
                            @for($i=0; $i<4; $i++)
                            <div class="upload-zone" id="zone-img-{{$i}}" onclick="if(!this.classList.contains('has-file')) document.getElementById('file-img-{{$i}}').click()">
                                <input type="file" name="images[]" id="file-img-{{$i}}" hidden accept="image/*" onchange="previewMedia(this, 'img', {{$i}})">
                                <button type="button" class="remove-btn" onclick="clearMedia(event, 'img', {{$i}})">×</button>
                                <div class="plus-icon"><i class="fas fa-camera"></i><span>Tải ảnh</span></div>
                                <img src="" id="prev-img-{{$i}}" style="display:none">
                                @if($i==0)<div class="main-img-label">ẢNH CHÍNH</div>@endif
                            </div>
                            @endfor
                        </div>

                        <label class="gl-label u-s-m-b-10 u-s-m-t-20">MODEL 3D (.GLB) *</label>
                        <div class="upload-zone model-zone" id="zone-model" onclick="if(!this.classList.contains('has-file')) document.getElementById('file-model').click()">
                            <input type="file" name="model_file" id="file-model" hidden accept=".glb" onchange="previewMedia(this, 'model', 0)">
                            <button type="button" class="remove-btn" onclick="clearMedia(event, 'model', 0)">×</button>
                            <div class="plus-icon"><i class="fas fa-cube"></i><span>Tải Model 3D</span></div>
                            <model-viewer id="prev-model" auto-rotate camera-controls style="display:none"></model-viewer>
                        </div>
                    </div>
                </div>

                <div class="modal-footer-flex u-s-m-t-30" style="display: flex; justify-content: flex-end; gap: 10px;">
                    <button class="btn btn--e-dark-outline" type="button" onclick="hideForm()">HỦY BỎ</button>
                    <button class="btn btn--e-brand-b-2" type="button" id="submit-form-btn-modal">LƯU THÔNG TIN</button>
                </div>
            </form>
        </div>
    </div>
</div>
