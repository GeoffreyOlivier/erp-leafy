<?php
//
//namespace App\Filament\Resources;
//
//use App\Filament\Resources\LayerResource\Pages;
//use App\Filament\Resources\LayerResource\RelationManagers;
//use App\Models\Layer;
//use Filament\Forms;
//use Filament\Forms\Form;
//use Filament\Resources\Resource;
//use Filament\Tables;
//use Filament\Tables\Table;
//use Illuminate\Database\Eloquent\Builder;
//use Illuminate\Database\Eloquent\SoftDeletingScope;
//
//class LayerResource extends Resource
//{
//    protected static ?string $model = Layer::class;
//
//    protected static ?string $navigationIcon = 'heroicon-o-square-3-stack-3d';
//
//    protected static ?string $navigationLabel = 'Couches';
//
//
//    public static function form(Form $form): Form
//    {
//        return $form
//            ->schema([
//                //
//            ]);
//    }
//
//    public static function table(Table $table): Table
//    {
//        return $table
//            ->columns([
//                //
//            ])
//            ->filters([
//                //
//            ])
//            ->actions([
//                Tables\Actions\EditAction::make(),
//            ])
//            ->bulkActions([
//                Tables\Actions\BulkActionGroup::make([
//                    Tables\Actions\DeleteBulkAction::make(),
//                ]),
//            ]);
//    }
//
//    public static function getRelations(): array
//    {
//        return [
//            //
//        ];
//    }
//
//    public static function getPages(): array
//    {
//        return [
//            'index' => Pages\ListLayers::route('/'),
//            'create' => Pages\CreateLayer::route('/create'),
//            'edit' => Pages\EditLayer::route('/{record}/edit'),
//        ];
//    }
//}
