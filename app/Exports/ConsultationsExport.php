<?php

namespace App\Exports;

use App\Models\Course;
use App\Models\Consultation;
use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use App\Exceptions\InternalErrorException;
use Exception;

class ConsultationsExport implements FromView, ShouldAutoSize, WithEvents, WithTitle, WithStyles
{
    public $request;
    public $param;
    public function __construct(Request $request, $param){
        $this->request = $request;
        $this->param = $param;
    }
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $fromDate = formatDate($this->request->get('fromDate'), 'Y-m-d 00:00:00');
        $toDate = formatDate($this->request->get('toDate'), 'Y-m-d 23:59:59');
        $export_course = $this->request->get('course');
        $consultations = Consultation::with('course')->select('name','email','phone','year_of_birth','address','course_id');
        $course = Course::find($export_course);
       try{
            if(!empty($course)){
                $consultations = $consultations->where('course_id', $course->id);
            }
            if(!empty($course) && !empty($this->param['search'])){
                $consultations = $consultations->where('course_id', $course->id)->where('name', 'like', "%" . $this->param['search'] . "%");
            }
            if(!empty($fromDate) && !empty($toDate)){
                $consultations = $consultations->whereBetween('created_at', [$fromDate, $toDate]);
            }elseif(!empty($fromDate) && empty($toDate)){
                $consultations = $consultations->where('consultations.created_at','>=',$fromDate);
            }else{
                $consultations = $consultations;
            }
       }catch( Exception $e){
            throw new InternalErrorException(__('consultations.exportExcel_error'));
       }
        return $consultations->get();
    }

    public function view(): View {
        return view('admin.consultations.exportExcel', ['consultations' => $this->collection()]);
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                $cellRange = 'A2:G2';
                $titleRange = 'A1';
                $color = '93ccea';
                $event->sheet->getDelegate()->getStyle($cellRange)->getFill()
                    ->setFillType(Fill::FILL_SOLID)
                    ->getStartColor()->setRGB($color);
                $event->sheet->getDelegate()->getStyle($cellRange)->getFont()->setSize(12);
                $event->sheet->getDelegate()->getStyle($titleRange)->getFont()->setSize(15);
                $event->sheet->setAutoFilter($cellRange);
            }
        ];

    }

    public function styles(Worksheet $sheet)
    {
        $titleRange = 'A1';
        $alphabet       = $sheet->getHighestDataColumn();
        $totalRow       = $sheet->getHighestDataRow();
        $cellRange      = 'A2:'.$alphabet.$totalRow;
        $styleArray = [
            'borders' => [
                'allBorders' => [
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                    'color' => ['argb' => '#000000'],
                    'font' => ['bold' => true],
                ],
            ],
            'alignment' => array(
                'horizontal' =>  \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
            )
        ];
        $sheet->getStyle($cellRange)->applyFromArray($styleArray)->getAlignment()->setWrapText(true);
        $sheet->getStyle($titleRange)->applyFromArray($styleArray);

    }

    public function title(): string
    {
        return __('export.list_register');
    }
}
