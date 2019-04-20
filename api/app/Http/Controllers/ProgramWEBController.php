<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\OMUDBClass\UnipaBlgn;

class ProgramWEBController extends Controller
{

	public function getAll(Request $request){
		/*
		$mod=$_GET['mod'];
		$Program=$_GET['Program'];
		//$Program=2648;

		$yil=isset($_GET['yil'])?$_GET['yil']:(date('md') > '0915')?date('Y'):date('Y') - 1;
		*/
		$dil = $request->route('dil');
		$mod = $request->route('mod');
		$Program = $request->route('program');
		$yil = (date('md') > '0915')?date('Y'):date('Y') - 1;
		

		$unipa=new UnipaBlgn($mod, $dil);
		$prg=$unipa->ProgramBilgiGetir($Program, $yil);

		$dersTuru=array(
					927001=>"Zorunlu"
					,927003=>"SDG"
					,927006=>"Ortak"
					,927005=>"-"
					);

		$dersTuru_en=array(
					927001=>"Compulsory"
					,927003=>"ECG"
					,927006=>"Common"
					,927005=>"-"
					);
		$general = $programme_outcomes = $course_structure_diagram_with_credits = '';
		foreach ($prg->ProgramTanimlari->ptb as $ptb)
		{
			$general .= "<h4 class='text-highlight'>{$ptb->ptbResx->BaslikAciklama}</h4>";
			if((string)$ptb->Sira=="3")
				$general .= "<p>".$unipa->getMod()."</p>";
			if(is_numeric((string)$ptb->ptbResx->ptResx->TanitimAciklama))
				$general .= "<p>".$unipa->getTitle('calismasekli', (string)$ptb->ptbResx->ptResx->TanitimAciklama)."</p>";
			else
				$general .= "<p>".nl2br($ptb->ptbResx->ptResx->TanitimAciklama)."</p>";
		}


		$programme_outcomes .= '<h4 class="text-highlight">'.$unipa->getTitle('pc').'</h4>';
		$programme_outcomes .= '<ol>';
		foreach ($prg->ProgramCiktilari->op as $pc)
		{
			$programme_outcomes .= "<li>{$pc->ProgramCiktisi}</li>";
		}
		$programme_outcomes .= '</ul></div>';

		foreach ($prg->Mufredat->m as $m)
		{
			if(!(int)$m->shd->SecmeliHavuzID)
			{
				$mufredat[(int)$m->Semester][]=$m;
				if((int)$m->SecmeliHavuzID)
				{
					$sec[(string)$m->d->dersCode]=$m;
				}
				
			}
		}


		$course_structure_diagram_with_credits .= "<h4 class='text-highlight'>".$unipa->getTitle('mf')."</h4>";
		$course_structure_diagram_with_credits .= $unipa->getTitle('t').":". $unipa->getTitle('te'). ", ".$unipa->getTitle('u').":".$unipa->getTitle('uy').", ".$unipa->getTitle('l').":".$unipa->getTitle('la');


		foreach ($mufredat as $sm=>$ders)
		{
			$course_structure_diagram_with_credits .= '<h5 class="text-highlight">' .$unipa->getTitle('sm'). ' ' .$sm. '</h5>';
			$course_structure_diagram_with_credits .= "<table class='table table-responsive'>
					
					<tr>
						<th width='100' align='left'>".$unipa->getTitle('dk')."</th>
						<th align='left'>".$unipa->getTitle('da')."</th>
						<th width='60'>".$unipa->getTitle('dt')."</th>
						<th width='20'>".$unipa->getTitle('t')."</th>
						<th width='20'>".$unipa->getTitle('u')."</th>
						<th width='20'>".$unipa->getTitle('l')."</th>
						<th width='50'>".$unipa->getTitle('kredi')."</th>
						<th width='50'>".$unipa->getTitle('akts')."</th>
					</tr>";
			
			$tT=0; $tA=0; $tLC=0; $tEC=0; $tC=0;
			foreach ($ders as $m)
			{
				$course_structure_diagram_with_credits .= "<tr>";
				if((int)$m->SecmeliHavuzID)
				$course_structure_diagram_with_credits .= "<td width='100'><a href='#havuzid{$m->SecmeliHavuzID}'>{$m->d->dersCode}</a></td>";
				else
				$course_structure_diagram_with_credits .= "<td width='100'><p>{$m->d->dersCode}</p></td>";
				
				$course_structure_diagram_with_credits .= "<td><p class='btn btn-sm btn-theme' onclick='openModal(this)' href='https://services.omu.edu.tr/fakulte/ders.php?dil={$dil}&zs=1&mod={$mod}&program={$Program}&did={$m->idDers}&mid={$m->idMufredat}&pmid={$m->d->pm->ProgramMufredatId}'>{$m->d->dersTitle}</p></td>
						<td align='center'>". ((isset($dersTuru[(string)$m->d->dersType]) && $dil == 'tr')?$dersTuru[(string)$m->d->dersType]:$dersTuru_en[(string)$m->d->dersType]) ."</td>
						<td align='center'>{$m->d->dersT}</td>
						<td align='center'>{$m->d->dersA}</td>
						<td align='center'>{$m->d->dersLC}</td>
						<td align='center'>".number_format((string)$m->d->dersC,1)."</td>
						<td align='center'>".number_format((string)$m->d->dersEC,1)."</td>
					</tr>";
				$tT+=(int)$m->d->dersT;
				$tA+=(int)$m->d->dersA;
				$tLC+=(int)$m->d->dersLC;
				$tEC+=(float)$m->d->dersEC;
				$tC+=(float)$m->d->dersC;
			}
			$course_structure_diagram_with_credits .= "<tr><td colspan='3' align='right'><b>".$unipa->getTitle('to')."</b></td>
					<td align='center'><b>{$tT}</b></td>
					<td align='center'><b>{$tA}</b></td>
					<td align='center'><b>{$tLC}</b></td>
					<td align='center'><b>".number_format($tC,1)."</b></td>
					<td align='center'><b>".number_format($tEC,1)."</b></td>
				</tr>
				</table>";
		}

		//--------Seçmeli Havuz İçerikleri------------
		if($dil == 'tr')
			$course_structure_diagram_with_credits .= "<h4 class='text-highlight'>Seçmeli Ders Grupları (SDG)</h4>";
		else
			$course_structure_diagram_with_credits .= "<h4 class='text-highlight'>Elective Course Groups (ECG)</h4>";

		foreach ($sec as $havuzDersCode=>$m)
		{
			if(isset($m->SecmeliHavuzID))
			{
				$course_structure_diagram_with_credits .= "<a name='havuzid{$m->SecmeliHavuzID}'></a>
					<table class='table table-responsive'>
					<tr><td colspan='8'>{$m->d->dersCode} / {$m->d->dersTitle}</td></tr>
					<tr>
						<th width='100' align='left'>".$unipa->getTitle('dk')."</th>
						<th align='left'>".$unipa->getTitle('da')."</th>
					<!--<th width='60'>".$unipa->getTitle('dt')."</th>-->
						<th width='20'>".$unipa->getTitle('t')."</th>
						<th width='20'>".$unipa->getTitle('u')."</th>
						<th width='20'>".$unipa->getTitle('l')."</th>
						<th width='50'>".$unipa->getTitle('kredi')."</th>
						<th width='50'>".$unipa->getTitle('akts')."</th>
						
					</tr>";

				$havuzdersleri=$unipa->HavuzDersleriGetir($m->SecmeliHavuzID, $m->idMufredat, $yil);
						$hv[]=$havuzdersleri;

				
				$doneminsecmelidersleri=array();
				if($havuzdersleri->m->shd)
				foreach($havuzdersleri->m->shd as $shd)
				{
					$dersC=$shd->d->dersT+($shd->d->dersA)/2;
					$course_structure_diagram_with_credits .= "<tr>
							<td><a>{$shd->d->dersCode}</a></td>
							<td><p class='btn btn-sm btn-theme' onclick='openModal(this)' href='https://services.omu.edu.tr/fakulte/ders.php?dil={$dil}&zs=2&mod={$mod}&program={$Program}&did={$shd->dersID}&mid={$m->idMufredat}&pmid={$shd->d->pm->ProgramMufredatId}'>{$shd->d->dersTitle}</p></td>
							<!--<td align='center'>{$shd->d->dersType}</td>-->
							<td align='center'>{$shd->d->dersT}</td>
							<td align='center'>{$shd->d->dersA}</td>
							<td align='center'>{$shd->d->dersLC}</td>
							<td align='center'>".number_format((string)$dersC,1)."</td>
							<td align='center'>".number_format((string)$shd->d->dersEC,1)."</td>
							
						</tr>";
				}
				$course_structure_diagram_with_credits .= "</table>";
			}
		}

		return response()->json(array('general' => $general, 'programme_outcomes' => $programme_outcomes, 'course_structure_diagram_with_credits' => $course_structure_diagram_with_credits,
		'pt' =>$unipa->getTitle('pt'), 'pc' =>$unipa->getTitle('pc'), 'mf' =>$unipa->getTitle('mf') ));
	}
}
