(function() {
  'use strict';
  /**
   * This module is used to simulate backend server for this demo application.
   */
  angular.module('content-mocks',['ngMockE2E'])
  
  .run(function($httpBackend) {

    var authorized = false;
    $httpBackend.whenPOST('http://54.183.86.60/v1/session').respond(function(method, url, data) {
      authorized = true;
      return [200];
    });
    $httpBackend.whenPOST('54.183.86.60/v1/session/delete').respond(function(method, url, data) {
      authorized = false;
      return [200];
    });
    
    
    $httpBackend.whenPOST('http://54.183.86.60/v1/session').respond(function(method, url, data) {
      return [200,'I have received and processed your data [' + data + '].'];
    });
    $httpBackend.whenPOST('data/protected').respond(function(method, url, data) {
      return authorized ? [200,'This is confidential [' + data + '].'] : [401];
    });

    //otherwise

    $httpBackend.whenGET(/.*/).passThrough();

  });
})();