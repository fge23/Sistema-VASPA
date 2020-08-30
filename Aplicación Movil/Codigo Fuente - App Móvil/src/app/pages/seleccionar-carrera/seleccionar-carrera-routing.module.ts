import { NgModule } from '@angular/core';
import { Routes, RouterModule } from '@angular/router';

import { SeleccionarCarreraPage } from './seleccionar-carrera.page';

const routes: Routes = [
  {
    path: '',
    component: SeleccionarCarreraPage
  }
];

@NgModule({
  imports: [RouterModule.forChild(routes)],
  exports: [RouterModule],
})
export class SeleccionarCarreraPageRoutingModule {}
