 <li id="proyectoactive" >
						<a href="#" class="dropdown-toggle">
							<i class="fa fa-desktop"></i>
							<span class="menu-text"> Proyecto {{ isset(Session::get('proyecto')->nombre) ? Session::get('proyecto')->nombre : ""}} </span>

							<b class="arrow fa fa-angle-down"></b>
						</a>

						<ul class="submenu">
							<!--
							<li>
								<a href={{ URL::to('proyectos/nuevo') }}>
									<i class="fa fa-angle-double-right"></i>
									Ingresar
								</a>
							</li>

							<li>
								<a href={{ URL::to('proyectos') }}>
									<i class="fa fa-angle-double-right"></i>
									Ver/Editar
								</a>
							</li>
							-->

							<li id='obraactive'>
						<a href="#" class="dropdown-toggle">
							<i class="fa fa-legal"></i>
							<span class="menu-text"> Obras </span>

							<b class="arrow fa fa-angle-down"></b>
						</a>

						<ul class="submenu">
							<li>
								<a href={{ URL::to('obras/nuevo') }}>
									<i class="fa fa-angle-double-right"></i>
									Ingresar
								</a>
							</li>

							<li>
								<a href={{ URL::to('obras') }}>
									<i class="fa fa-angle-double-right"></i>
									Ver/Editar
								</a>
							</li>

							
						</ul>
					</li>




					<li id="partidasactive"> 
						<a href="#" class="dropdown-toggle">
							<i class="fa fa-list"></i>
							<span class="menu-text"> Partidas </span>

							<b class="arrow fa fa-angle-down"></b>
						</a>

						<ul class="submenu">
							<li>
								<a href={{ URL::to('partidasEdificacion/nuevo') }}>
									<i class="fa fa-angle-double-right"></i>
									Ingresar
								</a>
							</li>

							<li>
								<a href={{ URL::to('partidasEdificacion') }}>
									<i class="fa fa-angle-double-right"></i>
									Ver/Editar
								</a>
							</li>

							
						</ul>
					</li>




<!--
					<li id="apuactive">
						<a href="#" class="dropdown-toggle">
							<i class="fa fa-adn"></i>
							<span class="menu-text"> APU </span>

							<b class="arrow fa fa-angle-down"></b>
						</a>

						<ul class="submenu">
							<li>
								<a href={{ URL::to('apu/nuevo') }}>
									<i class="fa fa-angle-double-right"></i>
									Ingresar
								</a>
							</li>

							<li>
								<a href={{ URL::to('apu') }}>
									<i class="fa fa-angle-double-right"></i>
									Ver/Editar
								</a>
							</li>

							
						</ul>
					</li>

-->

<li id="gastogeneralactive">
						<a href="#" class="dropdown-toggle">
							<i class="fa fa-usd"></i>
							<span class="menu-text"> Gastos Generales </span>

							<b class="arrow fa fa-angle-down"></b>
						</a>

						<ul class="submenu">
							<li>
								<a href={{ URL::to('gastogeneral/nuevo') }}>
									<i class="fa fa-angle-double-right"></i>
									Ingresar
								</a>
							</li>

							<li>
								<a href={{ URL::to('gastogeneral') }}>
									<i class="fa fa-angle-double-right"></i>
									Ver/Editar
								</a>
							</li>

							
						</ul>
					</li>


							
						</ul>
					</li>





<li id="controlcostoactive">
								<a href="#" class="dropdown-toggle">
									<i class="fa fa-adn"></i>

									Control de costos
									<b class="arrow fa fa-angle-down"></b>
								</a>

								<ul class="submenu">
									

									<li id="controlgastoactive">
						<a href="#" class="dropdown-toggle">
							<i class="fa fa-usd"></i>
					<span class="menu-text"> Control de gastos </span>

							<b class="arrow fa fa-angle-down"></b>
						</a>

						<ul class="submenu">
							<li>
								<a href={{ URL::to('controlgasto/nuevo') }}>
									<i class="fa fa-angle-double-right"></i>
									Ingresar
								</a>
							</li>

							<li>
								<a href={{ URL::to('controlgasto') }}>
									<i class="fa fa-angle-double-right"></i>
									Ver/Editar
								</a>
							</li>

							
						</ul>
					</li>



									<li id="controlingreso">
						<a href="#" class="dropdown-toggle">
							<i class="fa fa-usd"></i>
					<span class="menu-text"> Control de Ingreso </span>

							<b class="arrow fa fa-angle-down"></b>
						</a>

						<ul class="submenu">
							<li>
								<a href={{ URL::to('controlingreso/nuevo') }}>
									<i class="fa fa-angle-double-right"></i>
									Ingresar
								</a>
							</li>

							<li>
								<a href={{ URL::to('controlingreso') }}>
									<i class="fa fa-angle-double-right"></i>
									Ver/Editar
								</a>
							</li>

							
						</ul>
					</li>





				</ul><!--/.nav-list-->
			</li>






<li id="chequeactive">
						<a href="#" class="dropdown-toggle">
							<i class="fa fa-list-alt"></i>
					<span class="menu-text"> Cheques </span>

							<b class="arrow fa fa-angle-down"></b>
						</a>

						<ul class="submenu">
							<!--
							<li>
								<a href={{ URL::to('cheques/nuevo') }}>
									<i class="fa fa-angle-double-right"></i>
									Ingresar
								</a>
							</li>
-->
							<li>
								<a href={{ URL::to('cheques') }}>
									<i class="fa fa-angle-double-right"></i>
									Ver/Editar
								</a>
							</li>

							
						</ul>
					</li>



					<li>
								<a href={{ URL::to('controlgasto/informecontabilidad') }}>
									<i class="fa fa-angle-double-right"></i>
									Informe de Contabilidad
								</a>
							</li>


							<li id="presupuestoactive">
						<a href={{ URL::to('presupuestoEdificacion/nuevo') }} class="dropdown-toggle">
							<i class="fa fa-list-alt"></i>
					<span class="menu-text"> Presupuesto </span>

						</a>

					
					</li>



				


