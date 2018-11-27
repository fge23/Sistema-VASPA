import { NgModule } from '@angular/core';
import { IonicPageModule } from 'ionic-angular';
import { SeleccionarProgramaPage } from './seleccionar-programa';

@NgModule({
  declarations: [
    SeleccionarProgramaPage,
  ],
  imports: [
    IonicPageModule.forChild(SeleccionarProgramaPage),
  ],
})
export class SeleccionarProgramaPageModule {}
