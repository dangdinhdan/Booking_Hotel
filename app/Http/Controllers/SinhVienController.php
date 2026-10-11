<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreSinhVienRequest;
use App\Http\Requests\UpdateSinhVienRequest;
use App\Models\LopHoc;
use App\Models\SinhVien;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SinhVienController extends Controller
{
    private const SORTABLE = ['id', 'ma_sinh_vien', 'ho_ten', 'ngay_sinh', 'gioi_tinh', 'lop_hoc_id', 'trang_thai'];
    private const PER_PAGE_OPTIONS = [10, 20, 50, 100];

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $filters = Validator::make($request->query(), [
            'keyword' => 'nullable|string|max:100',
            'lop_hoc_id' => 'nullable|exists:lop_hocs,id',
            'gioi_tinh' => 'nullable|in:0,1',
            'trang_thai' => 'nullable|in:0,1',
            'sort' => 'nullable|in:' . implode(',', self::SORTABLE),
            'direction' => 'nullable|in:asc,desc',
            'perPage' => 'nullable|in:' . implode(',', self::PER_PAGE_OPTIONS),
        ])->valid();

        $sort = $filters['sort'] ?? 'id';
        $direction = $filters['direction'] ?? 'desc';
        $perPage = (int) ($filters['perPage'] ?? 10);

        $sinhViens = SinhVien::query()
            ->with('lopHoc')
            ->when(isset($filters['keyword']), function ($query) use ($filters) {
                $keyword = '%' . $filters['keyword'] . '%';
                $query->where(function ($q) use ($keyword) {
                    $q->where('ho_ten', 'like', $keyword)
                        ->orWhere('ma_sinh_vien', 'like', $keyword)
                        ->orWhere('email', 'like', $keyword)
                        ->orWhere('so_dien_thoai', 'like', $keyword);
                });
            })
            ->when(isset($filters['lop_hoc_id']), fn ($query) => $query->where('lop_hoc_id', $filters['lop_hoc_id']))
            ->when(isset($filters['gioi_tinh']), fn ($query) => $query->where('gioi_tinh', $filters['gioi_tinh']))
            ->when(isset($filters['trang_thai']), fn ($query) => $query->where('trang_thai', $filters['trang_thai']))
            ->orderBy($sort, $direction)
            ->paginate($perPage)
            ->withQueryString();

        $lopHocs = LopHoc::orderBy('ten_lop')->get();

        return view('sinh_viens.index', [
            'sinhViens' => $sinhViens,
            'lopHocs' => $lopHocs,
            'filters' => $filters,
            'sort' => $sort,
            'direction' => $direction,
            'perPage' => $perPage,
            'sortable' => self::SORTABLE,
            'perPageOptions' => self::PER_PAGE_OPTIONS,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $lopHocs = LopHoc::where('trang_thai', true)->orderBy('ten_lop')->get();

        return view('sinh_viens.create', [
            'lopHocs' => $lopHocs,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreSinhVienRequest $request)
    {
        SinhVien::create($request->validated());

        return redirect()->route('sinhvien.index')->with('success', 'Sinh viên đã được thêm thành công.');
    }

    /**
     * Display the specified resource.
     */
    public function show(SinhVien $sinhvien)
    {
        $sinhvien->load('lopHoc');

        return view('sinh_viens.show', [
            'sinhVien' => $sinhvien,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(SinhVien $sinhvien)
    {
        $lopHocs = LopHoc::orderBy('ten_lop')->get();

        return view('sinh_viens.edit', [
            'sinhVien' => $sinhvien,
            'lopHocs' => $lopHocs,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateSinhVienRequest $request, SinhVien $sinhvien)
    {
        $sinhvien->update($request->validated());

        return redirect()->route('sinhvien.index')->with('success', 'Thông tin sinh viên đã được cập nhật thành công.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SinhVien $sinhvien)
    {
        $sinhvien->delete();

        return back()->with('success', 'Sinh viên đã được xóa.');
    }
}
