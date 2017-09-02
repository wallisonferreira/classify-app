// // Api Search

// $('.ui.search')
//   .search({
//     apiSettings: {
//       url: 'www.omdbapi.com/?s={query}&apikey=d4ed399'
//     },
//     fields: {
//       results : 'Search',
//       title   : 'Title',
//       url     : 'Poster'
//     },
//     minCharacters : 3
//   })
// ;

// //url: '//api.github.com/search/repositories?q={query}'

// $('.ui.search')
//   .search({
//     type          : 'title',
//     minCharacters : 3,
//     apiSettings   : {
//       onResponse: function(ApiResponse) {
//         var
//           response = {
//             results : {}
//           }
//         ;
//         // translate GitHub API response to work with search
//         $.each(ApiResponse.Search, function(index, item) {
//           var
//             title   = item.Title || 'Unknown',
//           ;
//           if(index >= maxResults) {
//             return false;
//           }
//           // add result to category
//           response.results.push({
//             title       : item.Title,
//             description : item.Year,
//             url         : item.Poster
//           });
//         });
//         return response;
//       },
//       url: 'www.omdbapi.com/?s={query}&apikey=d4ed399'
//     }
//   })
// ;

$('.ui.sticky')
  .sticky({
    context: '#actionsticky'
  })
;