var vm = new Vue({
	el: '#charCounter',
	data: {
		message: '',
		counter: 0
	},
	watch: {
		message: function(val) {
			var vm = this;

			vm.counter = (val.length <= 250) ? val.length : (250 - val.length);
			vm.message = val.substring(0, 250);

			if (vm.counter >= 200 || vm.counter <= 0) {
				$('small').css({
					'color': 'red',
					'background': 'white'
				});
			} else {
				$('small').css({
					'color': 'white',
					'background': 'none'
				});
			}

			$('textarea').val(vm.message);
		}
	}
})
