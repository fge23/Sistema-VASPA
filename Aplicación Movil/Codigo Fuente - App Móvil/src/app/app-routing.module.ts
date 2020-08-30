import { NgModule } from '@angular/core';
import { PreloadAllModules, RouterModule, Routes } from '@angular/router';

const routes: Routes = [
  {
    path: 'home',
    loadChildren: () => import('./home/home.module').then( m => m.HomePageModule)
  },
  {
    path: '',
    redirectTo: 'home',
    pathMatch: 'full'
  },
  {
    path: 'seleccionar-carrera',
    loadChildren: () => import('./pages/seleccionar-carrera/seleccionar-carrera.module').then( m => m.SeleccionarCarreraPageModule)
  },
  {
    path: 'seleccionar-asignatura',
    loadChildren: () => import('./pages/seleccionar-asignatura/seleccionar-asignatura.module').then( m => m.SeleccionarAsignaturaPageModule)
  },
  {
    path: 'seleccionar-anio',
    loadChildren: () => import('./pages/seleccionar-anio/seleccionar-anio.module').then( m => m.SeleccionarAnioPageModule)
  },
];

@NgModule({
  imports: [
    RouterModule.forRoot(routes, { preloadingStrategy: PreloadAllModules })
  ],
  exports: [RouterModule]
})
export class AppRoutingModule { }
