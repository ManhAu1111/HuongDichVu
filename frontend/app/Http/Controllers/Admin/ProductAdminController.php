<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ProductAdminController extends Controller
{
    public function handleLocalUpload(Request $request)
    {
        $productId = $request->product_id;
        $results = ['images' => [], 'model' => null];

        // 1. Xử lý lưu Model 3D (.glb)
        if ($request->hasFile('model_file')) {
            $modelFile = $request->file('model_file');
            // Đường dẫn tương đối để lưu vào DB: uploads/model3d/32/file.glb
            $relativeDir = "uploads/model3d/{$productId}";
            $fullPath = public_path($relativeDir);

            // Tạo thư mục nếu chưa tồn tại
            if (!file_exists($fullPath)) {
                mkdir($fullPath, 0777, true);
            }

            $fileName = $modelFile->getClientOriginalName();
            $modelFile->move($fullPath, $fileName);

            $results['model'] = "{$relativeDir}/{$fileName}";
        }

        // 2. Xử lý lưu danh sách hình ảnh
        if ($request->hasFile('images')) {
            $relativeDir = "uploads/product_images/{$productId}";
            $fullPath = public_path($relativeDir);

            if (!file_exists($fullPath)) {
                mkdir($fullPath, 0777, true);
            }

            foreach ($request->file('images') as $index => $file) {
                // Đặt tên file theo thứ tự 1.png, 2.png...
                $fileName = ($index + 1) . '.' . $file->getClientOriginalExtension();
                $file->move($fullPath, $fileName);

                $results['images'][] = [
                    'url' => "{$relativeDir}/{$fileName}",
                    'is_primary' => ($index === 0 ? 1 : 0) // Ảnh đầu tiên là ảnh chính
                ];
            }
        }

        return response()->json($results);
    }
}
