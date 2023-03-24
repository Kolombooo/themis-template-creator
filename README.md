# How to create templates for Themis CMS

Naturally, we are lazy. We'd like to abuse our clients to work for us for free without them knowing it. That is why we're launching User-created Templates for Themis. Here is quick guide on how to make them.

## Creating the webpage itself

This is the hardest and the most fun step. You must prove your frontend design skills and create the webpage for the template. You can do this by simply creating a website like any other with dummy text *(like Lorem Impusm)* instead of actual website content.

## Installing the gateway

Create a new file called `gateway.php` in the root folder of your website. This file will communicate with our API and will display the desired content to your actual website. You can find the file here or copy the code below.

```php
<?php

function config() {
    $config = array(
        'projectid' => "*insert the project id*",
        'token' => "*insert the project token*"
    );
    return $config;
}

function element($key) {
    $json = file_get_contents('http://localhost/themisapi/element.php?projectid=' . config()['projectid'] . '&token=' . config()['token'] . '&element=' . $key);
    $obj = json_decode($json);
    return $obj;
}
```

In theory, this file send a GET request to out API and with function `element();`it will pull the element from the database and displays it.

## Marking the elements in your template

Remember the dummy text we used earlier? Now we have to replace it with element placeholders. Those pieces of code will change as the user edits the website in the administration. This can be done with calling the function `element();` followed by selecting the value called `result`. With these information, the line of code will look like this:

```php
<?php
echo element("element id")->{'result'};
?>
```

Replace the `element id` with the key you will use to identify your element. this should be formatted according to the following properties with dots in between them.

1. The template name
2. Section of the website you're currently displaying the element in
3. Element name

The final format should look like this:

`myTemplate.footer.copyright` (this could, for example, hold the data of `Copyright © 2023 - All rights reserved`)



**Pro tip!**

Does your code look shit? Let's do something about it!



This is your current piece of code.

```php
<?php
echo element("myTemplate.footer.copyright")->{'result'};
?>
```

We can make it single lined as it's just one echo function.

```php
<?php echo element("myTemplate.footer.copyright")->{'result'}; ?>
```

Now we can replace the `<?php` tag with a special trick tag `<?=` that will take the return of the function in it and automatically echo it for us.

```php
<?= element("myTemplate.footer.copyright")->{'result'}; ?>
```

Now we have a clean single lined code.



## Security measures

### Protecting the token

The user token is a very sensitive piece of data. Accessing it can allow hackers to read any element from the outside and even edit them in some cases.

To ensure the safety of project tokens, they are saved hashed in our database. Hashing them with SHA256 ensures their encryption.

#### What is hashing?

Hashing is a way for developers to one-way encrypt a certain string. One-way encryption means, that the token cannot be decrypted. To verify that the user supplies a correct token, we hash it as well and compare it with the stored one.



#### What do you need to do?

The main thing you can do is to never, **ever** allow the website visitors to view the token. We check every single template for this type of malicious code.

This below is a piece of code you should never include anywhere.

```php
<?= config()['token']; ?>
```



## Submitting the template

When you are done with creating your template, you need to document it properly. Write a document describing the necessary features and map all the elements you created. We need to know which element key has what label it has, what data type it is (a number, a string, a long text etc.) and default value. A label is a property, that is shown to the user in the administration. You can also separate those elements by sections using `template.section.id`.

Your element list could look like this:

| Key               | Label              | Type       | Default Value                           |
| ----------------- | ------------------ | ---------- | --------------------------------------- |
| debug.table.key1  | Key 1              | Short text | Dummy                                   |
| debug.table.key2  | Key 2              | Number     | 0                                       |
| debug.footer.info | Footer information | Short text | This is a debug template for Themis CMS |



### Where to send the template?

Compress your files to a RAR, ZIP or tar.gz file and send them to `founders@themiscms.eu`. Please include to following information:

1. Your name
2. Nationality
3. Whether you are considered legal aged in your country
4. If you want your template to be signed, please include a nickname (or your real name) you'd like it to be signed with



## That's it!

Thank you for creating a template for Themis CMS. As an open-source software, we love to see our community join the effort and create templates with us!
