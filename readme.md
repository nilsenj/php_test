
*This is some sort of a little bit of a real world example*

I just played around the files you gave and did some extra stuff))

Usually I don't do tests but for now I just did what I wanted

## Benefits:

1. We can have predefined mail campaign(mail composer) and templates
2. We have availability to create our mail campaign just doing this 
        $mail->doMail(new \App\MailComposers\DummyMailComposer(), "Voucher");
3. We have drivers configuration and instatiation it from Mailer
4. We have configuration
5. Datalayer not touched but defined in it's own directory and namespace

In this case I just used some sort of "Facade + something" pattern doing Mailer class

## Problems:
1. Better to create custom exception classes for each problem that might appear
2. Needs testing
3. Doesn't really tested on real mailserver)) just did from the head what I remember

**In case if you would tell me - "we need only refactoring"**

yes I know but it's up to you check, test it and make ideas of why I'm bad or good
you could just use some sort of abstract factory for different mails
another point is defining variables the right way - not just $c but $customer for example))
one more point is throwing errors or exceptions if they are in the loop which don't affect the work of the system and not critical
the best option is to throw exceptions on the lower level of business logic and catching it on the higher doing logger or
in case of the loop trying to skip if this is the problem of data layer complexity
point * we could use reflection to use for example our mail composer only by presenting the class name but i didn't do that sort of functionality))