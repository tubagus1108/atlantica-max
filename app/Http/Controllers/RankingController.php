<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use DataTables;

class RankingController extends Controller
{
    //Get Character
    public function getCharacters(){
        return view('ranking.character');
    }

    public function getCharactersDatatable(){
        $data = DB::connection('game')
            ->table('dbo.tbl_Person')
            ->join('dbo.tbl_SolMain', 'dbo.tbl_Person.PersonID', '=', 'dbo.tbl_SolMain.PersonID')
            ->leftJoin('AT_Community.dbo.tbl_GuildMember', 'dbo.tbl_Person.PersonID', '=', 'AT_Community.dbo.tbl_GuildMember.PersonID')
            ->leftJoin('AT_Community.dbo.tbl_GuildInfo', 'AT_Community.dbo.tbl_GuildMember.GuildUnique', '=', 'AT_Community.dbo.tbl_GuildInfo.GuildUnique')
            ->select('dbo.tbl_Person.Name as name', 'dbo.tbl_SolMain.Level as level', 'dbo.tbl_SolMain.Exp as experience', 'dbo.tbl_SolMain.PersonID as id', 'AT_Community.dbo.tbl_GuildInfo.GuildName as guild_name','AT_Community.dbo.tbl_GuildInfo.GuildUnique as id_guild')
            ->where('dbo.tbl_SolMain.PosType', 1)
            ->where('dbo.tbl_SolMain.SolIdx', 0)
            ->orderBy('dbo.tbl_SolMain.Level', 'desc') // Menambahkan orderBy untuk mengurutkan berdasarkan level dari tinggi ke rendah
            ->get();

        // Tambahkan kolom "DT_RowIndex" ke setiap baris data
        $data = $data->map(function ($item, $index) {
            $item->DT_RowIndex = $index + 1;
            return $item;
        });

        return DataTables::of($data)
        ->addColumn('name', function($data) {
            $detailCharacter = "'".route('characters.detail',[$data->id])."'";
            if (!empty($data->guild_name)) {
                $character_guild_name = '<a class="link-effect-4" href='.$detailCharacter.'>'.$data->name.'</a>&nbsp;/&nbsp;<a class="link-effect-4" href="/ranking/guild/10">'.$data->guild_name.'</a>';
            } else {
                $character_guild_name = '<a class="link-effect-4" href="/ranking/character/'.$data->id.'">'.$data->name.'</a>';
            }
            return $character_guild_name;
        })          
        ->rawColumns(['name'])
        ->make(true);
    }
    
    public function getCharactersDetail($id){
        $data = DB::connection('game')
            ->table('dbo.tbl_Person')
            ->where('dbo.tbl_Person.PersonID',$id)
            ->join('dbo.tbl_SolMain', 'dbo.tbl_Person.PersonID', '=', 'dbo.tbl_SolMain.PersonID')
            ->leftJoin('AT_Community.dbo.tbl_GuildMember', 'dbo.tbl_Person.PersonID', '=', 'AT_Community.dbo.tbl_GuildMember.PersonID')
            ->leftJoin('AT_Community.dbo.tbl_GuildInfo', 'AT_Community.dbo.tbl_GuildMember.GuildUnique', '=', 'AT_Community.dbo.tbl_GuildInfo.GuildUnique')
            ->select('dbo.tbl_Person.Name as name','dbo.tbl_Person.PlaySecond as play_second','dbo.tbl_Person.LastConnect as last_connect', 'dbo.tbl_SolMain.Level as level', 'dbo.tbl_SolMain.Exp as experience', 'dbo.tbl_SolMain.PersonID as id', 'AT_Community.dbo.tbl_GuildInfo.GuildName as guild_name','AT_Community.dbo.tbl_GuildInfo.GuildUnique as id_guild')
            ->where('dbo.tbl_SolMain.PosType', 1)
            ->where('dbo.tbl_SolMain.SolIdx', 0)
            ->orderBy('dbo.tbl_SolMain.Level', 'desc') // Menambahkan orderBy untuk mengurutkan berdasarkan level dari tinggi ke rendah
            ->get();
        
        return view('ranking.detail-character',compact('data'));
    }
}
