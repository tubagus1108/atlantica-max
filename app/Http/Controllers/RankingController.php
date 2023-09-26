<?php

namespace App\Http\Controllers;

use App\Models\Guild;
use App\Models\Person;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use DataTables;
use Ramsey\Uuid\Guid\Guid;
use App\Helpers\JobHelper;
use App\Helpers\JobHelpers;

class RankingController extends Controller
{
    //Get Character
    public function getCharacters(){
        return view('ranking.character');
    }

    public function getCharactersDatatable()
    {
        $data = Person::join('dbo.tbl_SolMain as solMain', 'dbo.tbl_Person.PersonID', '=', 'solMain.PersonID')
            ->leftJoin('AT_Community.dbo.tbl_GuildMember', 'dbo.tbl_Person.PersonID', '=', 'AT_Community.dbo.tbl_GuildMember.PersonID')
            ->leftJoin('AT_Community.dbo.tbl_GuildInfo', 'AT_Community.dbo.tbl_GuildMember.GuildUnique', '=', 'AT_Community.dbo.tbl_GuildInfo.GuildUnique')
            ->select('dbo.tbl_Person.Name as name', 'solMain.Level as level', 'solMain.Exp as experience', 'solMain.PersonID as id', 'AT_Community.dbo.tbl_GuildInfo.GuildName as guild_name', 'AT_Community.dbo.tbl_GuildInfo.GuildUnique as id_guild','solMain.Kind as job')
            ->where('solMain.PosType', 1)
            ->where('solMain.SolIdx', 0)
            ->orderBy('solMain.Level', 'desc')
            ->get();

        // Add the "DT_RowIndex" column to each data row
        $data->each(function ($item, $index) {
            $item->DT_RowIndex = $index + 1;
        });

        
        return DataTables::of($data)
            ->addColumn('name', function ($data) {
                $detailCharacter = route('characters.detail', [$data->id]);
                // dd($data->id_guild);
                if (!empty($data->guild_name)) {
                    $detailGuild = route('guilds.detail',[$data->id_guild]);
                    $character_guild_name = '<a class="link-effect-4" href="' . $detailCharacter . '">' . $data->name . '</a>&nbsp;/&nbsp;<a class="link-effect-4" href="' . $detailGuild . '">' . $data->guild_name . '</a>';
                } else {
                    $character_guild_name = '<a class="link-effect-4" href="'. $detailCharacter .'">' . $data->name . '</a>';
                }
                // dd($character_guild_name);
                return $character_guild_name;
            })
            ->addColumn('experience',function($data){
                return number_format($data->experience);
            })
            ->addColumn('job',function($data){
                $jobData = JobHelpers::getjobAsset($data->job);
                return '<img src="'.$jobData.'" alt="">';
            })
            ->rawColumns(['name','job'])
            ->make(true);
    }
    
    public function getCharactersDetail($id){
        $data = DB::connection('game')
            ->table('dbo.tbl_Person')
            ->where('dbo.tbl_Person.PersonID',$id)
            ->join('dbo.tbl_SolMain', 'dbo.tbl_Person.PersonID', '=', 'dbo.tbl_SolMain.PersonID')
            ->leftJoin('AT_Community.dbo.tbl_GuildMember', 'dbo.tbl_Person.PersonID', '=', 'AT_Community.dbo.tbl_GuildMember.PersonID')
            ->leftJoin('AT_Community.dbo.tbl_GuildInfo', 'AT_Community.dbo.tbl_GuildMember.GuildUnique', '=', 'AT_Community.dbo.tbl_GuildInfo.GuildUnique')
            ->select('dbo.tbl_Person.Name as name','dbo.tbl_Person.PlaySecond as play_second','dbo.tbl_Person.LastConnect as last_connect', 'dbo.tbl_SolMain.Level as level', 'dbo.tbl_SolMain.Exp as experience', 'dbo.tbl_SolMain.PersonID as id', 'AT_Community.dbo.tbl_GuildInfo.GuildName as guild_name','AT_Community.dbo.tbl_GuildInfo.GuildUnique as id_guild', 'dbo.tbl_SolMain.Kind as job','dbo.tbl_SolMain.Life as life','dbo.tbl_SolMain.Mana as mana')
            ->where('dbo.tbl_SolMain.PosType', 1)
            ->where('dbo.tbl_SolMain.SolIdx', 0)    
            ->orderBy('dbo.tbl_SolMain.Level', 'desc') // Menambahkan orderBy untuk mengurutkan berdasarkan level dari tinggi ke rendah
            ->get();
        
        if($data[0]->job){
            $jobData = JobHelpers::getjobAsset($data[0]->job);
        }
        return view('ranking.detail-character',compact('data','jobData'));
    }

    public function getGuilds(){
        return view('ranking.guild');
    }

    public function getGuildsDatatable(){
        $query = Guild::select('GuildName AS name', 'GuildLevel AS level', 'GuildExp AS experience','GuildUnique as id_guild')
            ->orderBy('GuildExp', 'DESC')
            ->get();    
        // Add the "DT_RowIndex" column to each data row
        $query->each(function ($item, $index) {
            $item->DT_RowIndex = $index + 1;
        });

        return DataTables::of($query)
            ->addColumn('name', function ($data) {
                $detailGuild = route('guilds.detail', [$data->id_guild]);
                $character_guild_name = '<a class="link-effect-4" href="'. $detailGuild .'">' . $data->name . '</a>';
                return $character_guild_name;
            })
            ->addColumn('experience',function($data){
                return number_format($data->experience);
            })
            ->rawColumns(['name'])
            ->make(true);
    }

    public function getGuildsDetail($id){
        $data = Guild::select('GuildName AS name', 'GuildLevel AS level', 'GuildExp AS experience','GuildUnique as id_guild','CDate as created_at')
            ->where('GuildUnique',$id)
            ->orderBy('GuildExp', 'DESC')
            ->get();    
        // dd($data);
        return view('ranking.detail-guild',compact('data'));
    }
}
