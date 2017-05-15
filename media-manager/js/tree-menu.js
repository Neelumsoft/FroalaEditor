angular
	.module("appModule", ["integralui"])
	.controller("appCtrl", ["$scope", "$timeout", "IntegralUITreeViewService", function($scope, $timeout, $treeService){
		$scope.treeName = "treeSample";
		$scope.itemIcon = "icons-medium empty-doc";
		$scope.checkStates = ['checked', 'indeterminate', 'unchecked'];
		$scope.currentState = 'checked';
		$scope.checkList = [];
		
            initTheme($scope, $treeService, $scope.treeName);

		$scope.items = [
			// { id: 1, text: "Solution 'Application1' (1 project)", icon: "icons-medium solution" },
			{ 
				id: 2,
				text: "Default Category",
				icon: "icons-medium documents",
				items: [
					{ 
						id: 21,
						pid: 2,
						text: "Root Category 001 (8)",
						icon: "icons-medium properties",
						expanded: false,
						items: [
							{ id: 211, pid: 21, text: "AssemblyInfo.cs", icon: "icons-medium assembly", checkState: 'checked' },
							{ id: 212, pid: 21, text: "licenses.licx", icon: "icons-medium notes" },
							{ 
								id: 213,
								pid: 21,
								text: "Resources.resx",
								expanded: false,
								icon: "icons-medium resources",
								items: [
									{ id: 2131, pid: 213, text: "Resources.Designer.cs" }
								]
							},
							{ 
								id: 214,
								pid: 21,
								text: "Settings.settings",
								icon: "icons-medium documents",
								expanded: false,
								items: [
									{ id: 2141, pid: 214, text: "Settings.Designer.cs", checkState: 'checked' }
								]
							}
						]
					},
					{ 
						id: 22,
						pid: 2,
						text: "Root Category 002 (30)",
						icon: "icons-medium references",
						expanded: false,
						checkState: 'checked',
						items: [
							{ id: 221, pid: 22, text: "System" },
							{ id: 222, pid: 22, text: "System.Data" },
							{ id: 223, pid: 22, text: "System.Deployment" },
							{ id: 224, pid: 22, text: "System.Drawing" },
							{ id: 225, pid: 22, text: "System.Xml" }
						]
					},
					{ 
						id: 23,
						pid: 2,
						text: "Root Category 003 (3)",
						icon: "icons-medium form",
						items: [
							{ id: 231, pid: 23, text: "Subcategory 003 -1 (3)", 
								items: [
									{ id: 233, pid: 234, text: "Subcategory 003 -1/1", checkState: 'checked' },
									{ id: 233, pid: 234, text: "Subcategory 003 -1/2", checkState: 'checked' },
									{ id: 233, pid: 234, text: "Subcategory 003 -1/3", checkState: 'checked' }
								]
							},
							{ id: 232, pid: 23, text: "Form1.resx", checkState: 'checked' }
						]
					},
					{ id: 24, pid: 2, text: "Program.cs", icon: "icons-medium new" }
				]
			}
		];

		var initTimer = $timeout(function(){
			$treeService.selectedItem($scope.treeName, $scope.items[0]);

			$treeService.updateView($scope.treeName);
			$treeService.updateCheckValues($scope.treeName);

			$timeout.cancel(initTimer);
		}, 1);

		$scope.checkBoxSettings = {
			autoCheck: true,
			threeState: true
		}

		$scope.showCheckList = function(){
			$scope.checkList = $treeService.getCheckList($scope.treeName, $scope.currentState);
		}

		$scope.itemCheckStateChanging = function(e){
			if (e.value == 'unchecked')
				e.item.checkState = 'checked';

		}
	}]);




