(function(angular, $, _) {
  angular.module('dedupegroup').config(function($routeProvider) {
      $routeProvider.when('/dedupegroup', {
        controller: 'DedupegroupDedupeGroup',
        controllerAs: '$ctrl',
        templateUrl: '~/dedupegroup/DedupeGroup.html',

        // If you need to look up data when opening the page, list it out
        // under "resolve".
        resolve: {
          dedupeConfig: function(crmApi) {
            return crmApi('Setting', 'getvalue', { name: 'dedupegroup' })
            .then(r => JSON.parse(r.result), e => alert('Error fetching config.'));
          },
          groupList: function(crmApi) {
            return crmApi('Group', 'get', {
              "sequential": 1,
              "return": ["id", "title"],
              'options' : { limit: 0 }
            })
            .then(r => r.values, e => alert('Error fetching config.'));
          },
          dedupeRuleList: function(crmApi) {
            return crmApi('RuleGroup', 'get', {
              "sequential": 1,
              "contact_type": "Individual",
              "return": ["id", "title"],
              'options' : { limit: 0 }
            })
            .then(r => r.values, e => alert('Error fetching config.'));
          }
        }
      });
    }
  );

  // The controller uses *injection*. This default injects a few things:
  //   $scope -- This is the set of variables shared between JS and HTML.
  //   crmApi, crmStatus, crmUiHelp -- These are services provided by civicrm-core.
  angular.module('dedupegroup').controller('DedupegroupDedupeGroup', function($scope, crmApi, crmStatus, crmUiHelp, groupList, dedupeRuleList, dedupeConfig) {
    var ts = $scope.ts = CRM.ts('nz.co.fuzion.dedupegroup');
    var hs = $scope.hs = crmUiHelp({file: 'CRM/dedupegroup/DedupeGroup'});

    $scope.dedupeConfig = dedupeConfig;
    this.groupList = groupList;
    this.dedupeRuleList = dedupeRuleList;

    this.save = function() {
        var config = $scope.dedupeConfig;
        return crmStatus(
            { start: ts('Saving...'), success: ts('Saved') },
            crmApi('Setting', 'create', { 'dedupegroup': JSON.stringify(config) })
        );
    };
});
 
})(angular, CRM.$, CRM._);
