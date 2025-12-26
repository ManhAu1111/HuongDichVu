<div id="product-form-container" style="display: none;">
    <style>
    .modal-overlay {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.7);
        z-index: 1000;
        display: flex;
        justify-content: center;
        align-items: center;
        padding: 20px;
    }

    .modal-content {
        background-color: #fff;
        padding: 30px;
        border-radius: 16px;
        width: 1400px;
        max-width: 95%;
        height: 90vh;
        display: flex;
        flex-direction: column;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3);
    }

    .modal-header {
        margin-bottom: 20px;
        flex-shrink: 0;
    }

    .modal-body-scroll {
        flex-grow: 1;
        overflow-y: auto;
        overflow-x: hidden;
        padding-right: 10px;
    }

    .modal-body-layout {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 50px;
        min-height: 100%;
    }

    .info-section {
        display: flex;
        flex-direction: column;
        height: 100%;
    }

    .info-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 20px;
        margin-bottom: 20px;
    }

    .gl-label {
        font-size: 15px;
        font-weight: 600;
        margin-bottom: 8px;
        display: block;
        color: #333;
    }

    .input-text--primary-style,
    .select-box--primary-style {
        height: 50px !important;
        font-size: 16px !important;
        width: 100%;
    }

    .description-container {
        flex-grow: 1;
        display: flex;
        flex-direction: column;
        margin-bottom: 25px;
        min-height: 250px;
    }

    .text-area--primary-style {
        flex-grow: 1;
        width: 100%;
        resize: none !important;
        font-size: 16px !important;
        padding: 15px;
        border-radius: 8px;
        border: 1px solid #ddd;
    }

    .modal-footer-left {
        display: flex;
        justify-content: flex-start;
        gap: 15px;
        padding-top: 20px;
        flex-shrink: 0;
    }

    .upload-section {
        display: flex;
        flex-direction: column;
        height: 100%;
    }

    .image-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 15px;
        margin-bottom: 20px;
    }

    .upload-zone {
        position: relative;
        border: 2px dashed #ccc;
        border-radius: 10px;
        height: 150px;
        display: flex;
        align-items: center;
        justify-content: center;
        background: #f9f9f9;
        cursor: pointer;
        overflow: hidden;
    }

    .upload-zone img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        position: absolute;
        top: 0;
        left: 0;
    }

    .main-img-label {
        position: absolute;
        bottom: 0;
        left: 0;
        width: 100%;
        background: #ff4500;
        color: white;
        font-size: 11px;
        text-align: center;
        padding: 4px 0;
        font-weight: bold;
        z-index: 15;
    }

    .model-zone {
        flex-grow: 1;
        width: 100%;
        position: relative;
        min-height: 300px;
        border-radius: 10px;
        overflow: hidden;
    }

    .remove-btn {
        position: absolute;
        top: 8px;
        right: 8px;
        background: rgba(255, 0, 0, 0.8);
        color: white;
        border: none;
        border-radius: 50%;
        width: 25px;
        height: 25px;
        cursor: pointer;
        display: none;
        z-index: 20;
        font-weight: bold;
    }

    .upload-zone.has-file .remove-btn {
        display: block;
    }
    </style>

    <div class="modal-overlay">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="dash__h1 u-c-secondary" id="form-title" style="font-size: 24px;">THÊM SẢN PHẨM</h1>
            </div>

            <form id="product-form" enctype="multipart/form-data" style="display: contents;">
                <input type="hidden" name="_method" id="form-method" value="POST">

                <div class="modal-body-scroll">
                    <div class="modal-body-layout">
                        <div class="info-section">
                            <div class="info-grid">
                                <div>
                                    <label class="gl-label">TÊN SẢN PHẨM *</label>
                                    <input class="input-text input-text--primary-style" type="text" id="product-name"
                                        name="name" required>
                                </div>
                                <div>
                                    <label class="gl-label">DANH MỤC *</label>
                                    <select class="select-box select-box--primary-style" id="product-category"
                                        name="category_id" required>
                                        <option value="">Chọn danh mục</option>
                                    </select>
                                </div>
                                <div>
                                    <label class="gl-label">GIÁ (VND) *</label>
                                    <input class="input-text input-text--primary-style" type="number" id="product-price"
                                        name="price" required>
                                </div>
                                <div>
                                    <label class="gl-label">KHO HÀNG *</label>
                                    <input class="input-text input-text--primary-style" type="number" id="product-stock"
                                        name="quantity" required>
                                </div>
                            </div>

                            <div class="description-container">
                                <label class="gl-label">MÔ TẢ *</label>
                                <textarea class="text-area text-area--primary-style" id="product-description"
                                    name="description" required></textarea>
                            </div>
                        </div>

                        <div class="upload-section">
                            <label class="gl-label u-s-m-b-10">HÌNH ẢNH (Ô 1 LÀ ẢNH CHÍNH) *</label>
                            <div class="image-grid">
                                @for($i = 0; $i < 4; $i++) <div class="upload-zone" id="zone-img-{{$i}}"
                                    onclick="if(!this.classList.contains('has-file')) document.getElementById('file-img-{{$i}}').click()">
                                    <input type="file" name="images[]" id="file-img-{{$i}}" hidden accept="image/*"
                                        onchange="previewMedia(this, 'img', {{$i}})">
                                    <button type="button" class="remove-btn"
                                        onclick="clearMedia(event, 'img', {{$i}})">×</button>
                                    <div class="plus-icon" style="color:#aaa; text-align:center;">
                                        <i class="fas fa-camera"></i><span style="display:block; font-size:10px;">Tải
                                            ảnh</span>
                                    </div>
                                    <img src="" id="prev-img-{{$i}}" style="display:none">
                                    @if($i == 0)
                                    <div class="main-img-label">ẢNH CHÍNH</div>@endif
                            </div>
                            @endfor
                        </div>

                        <label class="gl-label u-s-m-b-10 u-s-m-t-10">MODEL 3D (.GLB) *</label>
                        <div class="upload-zone model-zone" id="zone-model"
                            onclick="if(!this.classList.contains('has-file')) document.getElementById('file-model').click()">
                            <input type="file" name="model_file" id="file-model" hidden accept=".glb"
                                onchange="previewMedia(this, 'model', 0)">
                            <button type="button" class="remove-btn" onclick="clearMedia(event, 'model', 0)">×</button>
                            <div class="plus-icon" style="color:#aaa;">
                                <i class="fas fa-cube" style="font-size:24px;"></i>
                            </div>
                            <model-viewer id="prev-model" auto-rotate camera-controls touch-action="pan-y"
                                interaction-prompt="auto"
                                style="display:none; width: 100%; height: 100%; background-color: #f0f0f0; position: absolute; top:0; left:0;">
                            </model-viewer>
                        </div>
                    </div>
                </div>
        </div>

        <div class="modal-footer-left">
            <button class="btn btn--e-brand-b-2" type="button" id="submit-form-btn-modal"
                style="height: 45px; padding: 0 30px;">LƯU THÔNG TIN</button>
            <button class="btn btn--e-dark-outline" type="button" onclick="hideForm()"
                style="height: 45px; padding: 0 30px;">HỦY BỎ</button>
        </div>
        </form>
    </div>
</div>
</div>