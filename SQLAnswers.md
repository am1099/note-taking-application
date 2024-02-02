ANSWERS:

1. SELECT \* FROM submissions WHERE JSON_LENGTH(answers, '$.will.trustees') > 2;

2. SELECT SUM(JSON_UNQUOTE(JSON_EXTRACT(answers, '$.will.monetry_gifts[*].amount'))) as Total_gifts FROM submissions WHERE company_id = 2;

3. SELECT SUM(JSON_UNQUOTE(JSON_EXTRACT(answers, '$.will.monetry_gifts[*].amount'))) as charity_gifts FROM submissions WHERE id = 1
        AND JSON_UNQUOTE(JSON_EXTRACT(answers, '$.will.monetry_gifts[*].gift.recipient.is_charity')) = 'true';

4. $femaleTrustees = Submission::whereJsonContains('answers->will.trustees->gender', 'female')->whereJsonContains('answers->will.trustees','>=', 2)->get();
