fetch("./notice.json")
  .then(res => res.json())
  .then(data => {
    data.notice.sort((a, b) => {
      const dateA = new Date(a.date.replace(/\./g, '-'));
      const dateB = new Date(b.date.replace(/\./g, '-'));

      return dateB - dateA;
    });

    console.log(data.notice)
  });

  // <tr>
  //               <td>일반</td>
  //               <td>하월곡점 폐점으로 인한 영업종료 안내</td>
  //               <td>2024.07.31</td>
  //             </tr>
  //             <tr>
  //               <td>일반</td>
  //               <td>딘토 이벤트 조기 종료 안내</td>
  //               <td>2024.08.05</td>
  //             </tr>
  //             <tr>
  //               <td>일반</td>
  //               <td>[배송안내] 8/14(수)~8/15(목) 택배사 휴무 관련</td>
  //               <td>2024.08.06</td>
  //             </tr>
  //             <tr>
  //               <td>이벤트</td>
  //               <td>24년 7월 <헬스+출석체크인> 이벤트 당첨자 공지</td>
  //               <td>2024.08.08</td>
  //             </tr>
  //             <tr>
  //               <td>이벤트</td>
  //               <td>7월 [기프트몰TV 보러갈래?] 이벤트 당첨자 발표</td>
  //               <td>2024.08.07</td>
  //             </tr>